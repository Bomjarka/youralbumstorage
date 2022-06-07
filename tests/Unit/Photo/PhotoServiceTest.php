<?php

namespace Tests\Unit\Photo;

use App\Models\Photo;
use App\Models\User;
use App\Services\PhotoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_photo()
    {
        Storage::fake('public');

        $user = $this->createUser();

        $photoData = [
            'user_id' => $user->id,
            'photo_name' => 'Test name',
            'photo_description' => 'Test description',
            'album_id' => null,
            'user_photo' => UploadedFile::fake()->image('testphoto1.jpg'),
        ];

        $photo = (new PhotoService())->createPhoto($photoData);

        $this->assertModelExists($photo);
        $this->assertEquals($photoData['photo_name'], $photo->name);
        $this->assertEquals($photoData['photo_description'], $photo->description);
        $this->assertEquals($photoData['user_id'], $photo->user_id);

        Storage::disk('public')->assertExists($photo->photo_path);
        Storage::disk('public')->assertExists($photo->photo_preview_path);
    }

    /**
     * @return void
     */
    public function test_change_photo_name(): void
    {
        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        $newName = 'New Name';
        $this->assertNotEquals($newName, $photo->name);

        (new PhotoService())->changePhotoName($photo, $newName);
        $photo->refresh();

        $this->assertEquals($newName, $photo->name);
    }

    /**
     * @return void
     */
    public function test_change_photo_description(): void
    {
        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        $newDescription = 'New Description';
        $this->assertNotEquals($newDescription, $photo->description);

        (new PhotoService())->changePhotoDescription($photo, $newDescription);
        $photo->refresh();

        $this->assertEquals($newDescription, $photo->description);
    }

    /**
     * @return void
     */
    public function test_delete_photo(): void
    {
        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        (new PhotoService())->deletePhoto($photo);

        $this->assertSoftDeleted($photo);
    }

    /**
     * @return void
     */
    public function test_delete_photo_permanent(): void
    {
        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        (new PhotoService())->deletePhotoPermanently($photo);

        $this->assertDeleted($photo);
    }

    public function test_restore_photo()
    {
        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        (new PhotoService())->deletePhoto($photo);
        $this->assertSoftDeleted($photo);

        (new PhotoService())->restorePhoto($photo);
        $this->assertNotSoftDeleted($photo);
    }


    /**
     * @return Collection|Model
     */
    private function createUser()
    {
        return User::factory()->create(['is_verified' => true, 'is_blocked' => false]);
    }

    /**
     * @param User $user
     * @param int|null $albumId
     * @return Photo
     */
    private function createPhoto(User $user, int $albumId = null): Photo
    {
        $data = [
            'user_id' => $user->id,
            'photo_name' => 'Photo 1',
            'photo_description' => 'Description',
            'user_photo' => UploadedFile::fake()->image('photo1.jpg'),
            'album_id' => $albumId,
        ];

        return (new PhotoService())->createPhoto($data);
    }
}
