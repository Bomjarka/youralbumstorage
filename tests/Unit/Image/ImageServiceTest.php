<?php

namespace Tests\Unit\Image;

use App\Models\Photo;
use App\Models\User;
use App\Services\ImageService;
use App\Services\PhotoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_image(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $file = UploadedFile::fake()->image('testphoto1.jpg');

        $this->assertFalse(Storage::disk('public')->exists('/userphotos/' . $user->id));

        $path = (new ImageService())->createImage($file, $user->id);

        Storage::disk('public')->assertExists($path);
    }

    /**
     * @return void
     */
    public function test_create_preview(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $file = UploadedFile::fake()->image('testphoto1.jpg');

        $this->assertFalse(Storage::disk('public')->exists('/userphotos/' . $user->id . '/prview'));

        $path = (new ImageService())->createPreview($file, $user->id);
        $image = Image::make(Storage::disk('public')->path($path));

        $this->assertEquals(400, $image->getHeight());
        $this->assertEquals(600, $image->getWidth());
        Storage::disk('public')->assertExists($path);
    }

    /**
     * @return void
     */
    public function test_delete_image(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $photo = $this->createPhoto($user);

        Storage::disk('public')->assertExists($photo->photo_path);
        Storage::disk('public')->assertExists($photo->photo_preview_path);

        (new ImageService())->deleteImage($photo);

        $this->assertFalse(Storage::disk('public')->exists($photo->photo_path));
        $this->assertFalse(Storage::disk('public')->exists($photo->photo_preview_path));

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
