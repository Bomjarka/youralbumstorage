<?php

namespace Tests\Feature\User\Albums;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Models\User;
use App\Services\AlbumService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Пользователь может просматривать страницу альбомов без них
     *
     */
    public function test_user_view_empty_albums_page(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/albums');

        $response->assertViewHas('albums');
        $response->assertStatus(200);
    }

    /**
     * Пользователь может просматривать страницу альбомов с ними
     *
     */
    public function test_user_view_albums_page(): void
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

    /**
     * Пользователь может просматривать страницу альбома без фотографий
     *
     */
    public function test_user_view_empty_album_page(): void
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

    /**
     * Пользователь может просматривать страницу альбома с фотографиями
     *
     */
    public function test_user_view_not_empty_album(): void
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

    /**
     * Пользователь может создать альбом
     *
     */
    public function test_user_can_create_album(): void
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

    /**
     * Пользователь может удалить альбом
     *
     */
    public function test_user_can_delete_album(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            '_token' => csrf_token(),
        ];

        $this->assertNotNull($album);
        $this->assertNotSoftDeleted($album);
        $this->actingAs($user);

        $response = $this->post('/albums/' . $album->id . '/delete', $data);
        $album = $album->fresh();

        $this->assertSoftDeleted($album);
        $response->assertStatus(302);
    }

    /**
     * Пользователь может редактировать альбом
     *
     */
    public function test_user_can_edit_album(): void
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

    /**
     * Пользователь может восстановить альбом
     *
     */
    public function test_user_can_restore_album(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertNotSoftDeleted($album);
        $this->actingAs($user);

        (new AlbumService())->deleteAlbum($album);

        $this->assertSoftDeleted($album);


        $restoreResponse = $this->post('profile/trash/albums', ['albumId' => $album->id]);
        $album->refresh();

        $restoreResponse->assertJson(['msg' => 'Album restored!']);
        $restoreResponse->assertStatus(200);
        $this->assertNotSoftDeleted($album);
    }
}
