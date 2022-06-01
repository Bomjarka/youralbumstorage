<?php

namespace Tests\Feature\User\Photos;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notification;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Notification as FakeNotification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    //страница без фото
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

    public function test_user_can_create_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $userPhotos = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhotos);

        $data = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name',
            'photo_description' => 'Test create photo description',
            'user_photo' => UploadedFile::fake()->image('testphoto.jpg'),
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $data);
        $userPhotos = Photo::whereUserId($user->id)->first();

        Storage::disk('public')->assertExists($userPhotos->photo_path);
        Storage::disk('public')->assertExists($userPhotos->photo_preview_path);
        $this->assertNotNull($userPhotos);
        $this->assertEquals('Test create photo name', $userPhotos->name);
        $this->assertEquals('Test create photo description', $userPhotos->description);
        $response->assertStatus(302);
    }

    public function test_user_can_create_photo_in_album()
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $userPhoto = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhoto);

        $data = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name for album ' . $album->id,
            'photo_description' => 'Test create photo description for album ' . $album->id,
            'user_photo' => UploadedFile::fake()->image('testphoto.jpg'),
            'album_id' => $album->id,
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $data);
        $userPhotoAtAlbum = $user->albums->first()->photos->first();

        Storage::disk('public')->assertExists($userPhotoAtAlbum->photo_path);
        Storage::disk('public')->assertExists($userPhotoAtAlbum->photo_preview_path);
        $this->assertNotNull($userPhotoAtAlbum);
        $this->assertEquals('Test create photo name for album ' . $album->id, $userPhotoAtAlbum->name);
        $this->assertEquals('Test create photo description for album ' . $album->id, $userPhotoAtAlbum->description);
        $response->assertStatus(302);
    }

    public function test_user_can_edit_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $userPhoto = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhoto);

        $dataForCreatePhoto = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name',
            'photo_description' => 'Test create photo description',
            'user_photo' => UploadedFile::fake()->image('testphoto.jpg'),
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $dataForCreatePhoto);
        $userPhoto = Photo::whereUserId($user->id)->first();

        Storage::disk('public')->assertExists($userPhoto->photo_path);
        Storage::disk('public')->assertExists($userPhoto->photo_preview_path);
        $this->assertNotNull($userPhoto);
        $this->assertEquals('Test create photo name', $userPhoto->name);
        $this->assertEquals('Test create photo description', $userPhoto->description);
        $response->assertStatus(302);

        $dataForUpdatePhoto = [
            'photo_name' => 'Test edit photo name',
            'photo_description' => 'Test edit photo description',
            '_token' => csrf_token(),
        ];

        $response = $this->post('/photos/' . $userPhoto->id . '/edit', $dataForUpdatePhoto);
        $userPhoto->refresh();

        $this->assertEquals('Test edit photo name', $userPhoto->name);
        $this->assertEquals('Test edit photo description', $userPhoto->description);
        $response->assertStatus(302);
    }

    public function test_user_can_delete_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $userPhoto = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhoto);

        $dataForCreatePhoto = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name',
            'photo_description' => 'Test create photo description',
            'user_photo' => UploadedFile::fake()->image('testphoto.jpg'),
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $dataForCreatePhoto);
        $userPhoto = Photo::whereUserId($user->id)->first();

        Storage::disk('public')->assertExists($userPhoto->photo_path);
        Storage::disk('public')->assertExists($userPhoto->photo_preview_path);
        $this->assertNotNull($userPhoto);
        $this->assertEquals('Test create photo name', $userPhoto->name);
        $this->assertEquals('Test create photo description', $userPhoto->description);
        $response->assertStatus(302);

        $dataForDeletePhoto = [
            '_token' => csrf_token(),
        ];

        $response = $this->post('/photos/' . $userPhoto->id . '/delete', $dataForDeletePhoto);
        $userPhoto->refresh();

        $this->assertNotNull($userPhoto->deleted_at);
        $response->assertStatus(302);
    }

    public function test_user_can_move_photo_to_album()
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_blocked' => false]);
        $album = Album::factory()->create([
            'user_id' => $user->id,
        ]);

        $userPhoto = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhoto);

        $data = [
            'user_id' => $user->id,
            'photo_name' => 'Test create photo name',
            'photo_description' => 'Test create photo name',
            'user_photo' => UploadedFile::fake()->image('testphoto.jpg'),
            '_token' => csrf_token(),
        ];

        $this->actingAs($user);

        $response = $this->post('/photos/create', $data);

        $userPhotoAtAlbum = $user->albums->first()->photos->first();
        $userPhoto = Photo::whereUserId($user->id)->first();

        Storage::disk('public')->assertExists($userPhoto->photo_path);
        Storage::disk('public')->assertExists($userPhoto->photo_preview_path);
        $this->assertNotNull($userPhoto);
        $this->assertEquals('Test create photo name', $userPhoto->name);
        $this->assertEquals('Test create photo name', $userPhoto->description);
        $this->assertNull($userPhotoAtAlbum);
        $response->assertStatus(302);


        $dataForUpdatePhoto = [
            'photo_name' => 'Test edit photo name for album ' . $album->id,
            'photo_description' => 'Test edit photo for album ' . $album->id,
            'album_id' => $album->id,
            '_token' => csrf_token(),
        ];

        $response = $this->post('/photos/' . $userPhoto->id . '/edit', $dataForUpdatePhoto);
        $userPhoto->refresh();

        $albumPhoto = AlbumPhotos::whereAlbumId($album->id)
            ->wherePhotoId($userPhoto->id)
            ->first();

        $this->assertEquals('Test edit photo name for album ' . $album->id, $userPhoto->name);
        $this->assertEquals('Test edit photo for album ' . $album->id, $userPhoto->description);
        $this->assertNotNull($albumPhoto);
        $response->assertStatus(302);
    }

    public function test_user_can_download_all_photos()
    {
        Storage::fake('public');
        FakeNotification::fake();

        $user = User::factory()->create(['is_blocked' => false]);
        $userPhotos = Photo::whereUserId($user->id)->first();
        $this->assertNull($userPhotos);

        $this->actingAs($user);

        for ($i = 1; $i <= 3; $i++) {
            $data = [
                'user_id' => $user->id,
                'photo_name' => 'Test create photo ' . $i . ' name',
                'photo_description' => 'Test create photo ' . $i . ' description',
                'user_photo' => UploadedFile::fake()->image('testphoto' . $i . '.jpg'),
                '_token' => csrf_token(),
            ];
            $response = $this->post('/photos/create', $data);

            $userPhotos = Photo::whereUserId($user->id)
                ->whereId($i)
                ->first();

            Storage::disk('public')->assertExists($userPhotos->photo_path);
            Storage::disk('public')->assertExists($userPhotos->photo_preview_path);
            $this->assertNotNull($userPhotos);
            $this->assertEquals('Test create photo ' . $i . ' name', $userPhotos->name);
            $this->assertEquals('Test create photo ' . $i . ' description', $userPhotos->description);
            $response->assertStatus(302);
        }

        $dataToPressDownloadButton = [
            'userId' => $user->id,
            '_token' => csrf_token(),
        ];

        $archivePath = 'userphotos/' . $user->id . '/photos.zip';
        $presDownloadButtonResponse = $this->post('/download_all_photos', $dataToPressDownloadButton);

        $presDownloadButtonResponse->assertJson(['msg' => 'success']);
        $presDownloadButtonResponse->assertStatus(200);
        Storage::disk('public')->assertExists($archivePath);
        FakeNotification::assertSentTo($user, DownloadPhotosNotification::class);

        $dataToDownloadArchive = [
            '_token' => csrf_token(),
        ];

        $downloadArchiveResponse = $this->get('/download/photos.zip', $dataToDownloadArchive);
        $downloadArchiveResponse->assertDownload('photos.zip');
    }

}
