<?php

namespace Tests\Unit\User;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\UserDeletedNotification;
use App\Services\PhotoService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification as FakeNotification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;


    /**
     * @return void
     */
    public function test_block_user(): void
    {
        $user = $this->createUser();
        (new UserService())->blockUser($user);
        $user->refresh();

        $this->assertTrue($user->isBlocked());
    }

    /**
     * @return void
     */
    public function test_unblock_user(): void
    {
        $user = $this->createUser();
        (new UserService())->unblockUser($user);
        $user->refresh();

        $this->assertFalse($user->isBlocked());
    }

    /**
     * @return void
     */
    public function test_delete_user(): void
    {
        FakeNotification::fake();

        $user = $this->createUser();
        (new UserService())->deleteUser($user);
        $user->refresh();

        $this->assertDeleted($user);
        FakeNotification::assertSentTo($user, UserDeletedNotification::class);
    }

    /**
     * @return void
     */
    public function test_delete_user_with_photos(): void
    {
        Storage::fake('public');
        FakeNotification::fake();

        $user = $this->createUser();
        $album = $this->createAlbum($user);
        $photo1 = $this->createPhoto($user);
        $photo2 = $this->createPhoto($user, $album->id);

        $this->assertModelExists($user);
        $this->assertModelExists($album);
        $this->assertModelExists($photo1);
        $this->assertModelExists($photo2);
        Storage::disk('public')->assertExists($photo1->photo_path);
        Storage::disk('public')->assertExists($photo1->photo_preview_path);
        Storage::disk('public')->assertExists($photo2->photo_path);
        Storage::disk('public')->assertExists($photo2->photo_preview_path);

        (new UserService())->deleteUser($user);
        $user->refresh();

        $this->assertDeleted($user);
        $this->assertDeleted($album);
        $this->assertDeleted($photo1);
        $this->assertDeleted($photo2);
        FakeNotification::assertSentTo($user, UserDeletedNotification::class);
        $this->assertFalse(Storage::disk('public')->exists($photo1->photo_path));
        $this->assertFalse(Storage::disk('public')->exists($photo1->photo_preview_path));
        $this->assertFalse(Storage::disk('public')->exists($photo2->photo_path));
        $this->assertFalse(Storage::disk('public')->exists($photo2->photo_path));
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
