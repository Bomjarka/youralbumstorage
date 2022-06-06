<?php

namespace Tests\Unit\Photo;

use App\Models\Album;
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

class PhotoTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_associate_with_album(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $album = $this->createAlbum($user);
        $photo = $this->createPhoto($user);

        $this->assertNull($album->photos->first());

        $photo->associateAlbumPhoto($album->id);
        $this->assertNotNull($album->fresh()->photos->first());
    }

    public function test_diassociate_with_album(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $album = $this->createAlbum($user);
        $photo = $this->createPhoto($user, $album->id);

        $this->assertNotNull($album->photos->first());

        $photo->disassociateAlbumPhoto($album->id);
        $this->assertNull($album->fresh()->photos->first());
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
     * @return Collection|Model
     */
    private function createAlbum(User $user)
    {
        return Album::factory(['user_id' => $user])->create();
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
