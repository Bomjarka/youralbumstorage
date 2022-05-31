<?php

namespace Tests\Feature\User\Albums;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    //страница без альбомов
    public function test_user_view_empty_albums_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/albums');

        $response->assertViewHas('albums');
        $response->assertStatus(200);
    }

    //страница со всеми альбомами
    public function test_user_view_albums_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/albums');
        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($data['albums'][0]['id'], $album->id);
        $response->assertViewHas('albums', $data['albums']);
        $response->assertStatus(200);
    }

    //страница альбома без фото
    public function test_user_view_empty_album_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/albums/' . $album->id);


        $response->assertViewHas('album', $album);
        $response->assertStatus(200);
    }

    //страница альбома с фото
    public function test_user_view_not_empty_album()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);
        $photo = Photo::factory()->create([
            'user_id' => $user->id,
        ]);
        $albumPhoto = AlbumPhotos::create([
            'album_id' => $album->id,
            'photo_id' => $photo->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/albums/' . $album->id);
        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($data['photos'][0]['id'], $photo->id);
        $response->assertViewHas('album', $album);
        $response->assertViewHas('photos', $data['photos']);
        $response->assertStatus(200);
    }

    public function test_user_can_create_album()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $userAlbums = Album::whereUserId($user->id)->first();

        $this->assertNull($userAlbums);

        $data = [
            'user_id' => $user->id,
            'album_name' => 'Test create album name',
            'album_description' => 'Test create album description',
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/albums/create', $data);
        $userAlbums = Album::whereUserId($user->id)->first();

        $this->assertNotNull($userAlbums);
        $response->assertStatus(302);
    }

    public function test_user_can_delete_album()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            '_token' => csrf_token(),
        ];

        $this->assertNotNull($album);
        $this->assertNull($album->deleted_at);
        $this->actingAs($user);

        $response = $this->post('/albums/' . $album->id . '/delete', $data);
        $album = $album->fresh();

        $this->assertNotNull($album->deleted_at);
        $response->assertStatus(302);
    }

    public function test_user_can_edit_album()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $oldAlbumName = $album->name;
        $oldAlbumDescription = $album->description;

        $data = [
            'album_name' => 'Test edit album name',
            'album_description' => 'Test edit album description',
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/albums/' . $album->id . '/edit', $data);
        $album->refresh();

        $this->assertNotEquals($oldAlbumName, $album->name);
        $this->assertNotEquals($oldAlbumDescription, $album->description);
        $response->assertStatus(302);
    }
}
