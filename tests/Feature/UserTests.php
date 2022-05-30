<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTests extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_view_home()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }

    //страница со всеми альбомами
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

    //страница со всеми фото
    public function test_user_view_empty_photos_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/photos');

        $response->assertViewHas('photos');
        $response->assertStatus(200);
    }

    //страница со всеми фото
    public function test_user_view_photos_page()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $photo = Photo::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/photos');
        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($data['photos'][0]['id'], $photo->id);
        $response->assertViewHas('photos', $data['photos']);
        $response->assertStatus(200);
    }

    public function test_user_view_about()
    {
        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($user);
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_user_view_profile()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $this->actingAs($user);

        $response = $this->get('/profile');

        $response->assertViewHas('user', $user);
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

    public function test_user_can_send_feedback()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $data = [
            'name' => $user->fullName(),
            'email' => $user->email,
            'message' => 'Message from user . ' . $user->id . ' !',
        ];

        $this->actingAs($user);
        $response = $this->withoutMiddleware()->post('/feedback', $data);

        $response->assertStatus(302);
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

        $this->withoutMiddleware()->post('/albums/create', $data);

        $userAlbums = Album::whereUserId($user->id)->first();
        $this->assertNotNull($userAlbums);
    }

//    public function test_user_can_delete_album()
//    {
//        $user = User::factory()->create(['is_blocked' => false]);
//        $album = Album::factory()->create([
//            'user_id' => $user->id,
//        ]);
//        $userAlbums = Album::whereUserId($user->id)->first();
//
//        $data = [
//            '_token' => csrf_token(),
//        ];
//
//        $this->assertNotNull($userAlbums);
//        $this->actingAs($user);
//
//        $response = $this->post('/albums/' . $album->id . '/delete', $data);
//
//        $userAlbums= Album::whereUserId($user->id)->first();
//
//        $this->assertNull($userAlbums);
//    }

}
