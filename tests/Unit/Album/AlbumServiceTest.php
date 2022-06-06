<?php

namespace Tests\Unit\Album;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use App\Services\AlbumService;
use App\Services\PhotoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AlbumServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_album(): void
    {
        $user = $this->createUser();
        $this->assertNull($user->albums()->first());

        $data = [
            'user_id' => $user->id,
            'album_name' => 'Test name',
            'album_description' => 'Test description',
        ];

        (new AlbumService())->createAlbum($data);
        $album = $user->albums()->first();

        $this->assertNotNull($album);
        $this->assertEquals($data['album_name'], $album->name);
        $this->assertEquals($data['album_description'], $album->description);
    }

    /**
     * @return void
     */
    public function test_change_album_name(): void
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);

        $newName = 'New Name';
        $this->assertNotEquals($newName, $album->name);

        (new AlbumService())->changeAlbumName($album, $newName);
        $album->refresh();

        $this->assertEquals($newName, $album->name);
    }

    /**
     * @return void
     */
    public function test_change_album_description(): void
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);

        $newDescription = 'New Description';
        $this->assertNotEquals($newDescription, $album->description);

        (new AlbumService())->changeAlbumDescription($album, $newDescription);
        $album->refresh();

        $this->assertEquals($newDescription, $album->description);
    }

    /**
     * @return void
     */
    public function test_delete_album(): void
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);

        (new AlbumService())->deleteAlbum($album);

        $this->assertSoftDeleted($album);
    }

    /**
     * @return void
     */
    public function test_delete_album_with_photos(): void
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);
        $photo = $this->createPhoto($user, $album->id);

        (new AlbumService())->deleteAlbum($album, true);

        $this->assertSoftDeleted($album);
        $this->assertSoftDeleted($photo);
    }

    /**
     * @return void
     */
    public function test_delete_album_permanent(): void
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);

        (new AlbumService())->deleteAlbumPermanently($album);

        $this->assertDeleted($album);
    }

    public function test_restore_album()
    {
        $user = $this->createUser();
        $album = $this->createAlbum($user);

        (new AlbumService())->deleteAlbum($album);
        $this->assertSoftDeleted($album);

        (new AlbumService())->restoreAlbum($album);
        $this->assertNotSoftDeleted($album);
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
