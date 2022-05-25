<?php

namespace App\Services;

use App\Helpers\RoleHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use TheSeer\Tokenizer\Exception;

class UserService
{

    protected $albumService;
    protected $photoService;
    protected $roleService;

    public function __construct(AlbumService $albumService, PhotoService $photoService, RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->photoService = $photoService;
        $this->albumService = $albumService;
    }

    /**
     * @param $userData
     * @param User $user
     * @return void
     */
    public function editData($userData, User $user): void
    {
        $user->login = $userData['login'];
        $user->first_name = $userData['firstName'];
        $user->second_name = $userData['secondName'];
        $user->last_name = $userData['lastName'];
        $user->sex = $userData['gender'];
        $user->phone = $userData['phone'];
        $user->email = $userData['email'];
        $user->birthdate = $userData['birthdate'];

        $user->save();
    }

    /**
     * @param User $user
     * @return void
     */
    public function blockUser(User $user): void
    {
        $user->is_blocked = true;
        $user->save();
    }

    /**
     * @param User $user
     * @return void
     */
    public function unblockUser(User $user): void
    {
        $user->is_blocked = false;
        $user->save();
    }

    /**
     * Удаляем пользователя и все данные, которые с ним связаны
     *
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool
    {
        $userAlbums = $user->albums()->withTrashed();
        $userPhotos = $user->photos()->withTrashed();
        $userRoles = $this->roleService->getUserRoles($user->id);

        Log::info("Deleting user from system", [
            'user' => $user,
            'albumsCount' => $userAlbums,
            'photosCount' => $userPhotos
        ]);


        try {
            if ($userRoles->count() > 0) {
                foreach ($userRoles as $userRole) {
                    $this->roleService->removeRoleUser($userRole->name, $user->id);
                }
            }

            if ($userAlbums || $userPhotos) {

                foreach ($userAlbums->cursor() as $userAlbum) {
                    $this->albumService->deleteAlbum($userAlbum, true);
                }

                foreach ($userPhotos->cursor() as $userPhoto) {
                    $this->photoService->deletePhotoPermanently($userPhoto);
                }

                foreach ($userAlbums->cursor() as $deletedAlbum) {
                    $this->albumService->deleteAlbumPermanently($deletedAlbum);
                }

                Storage::disk('public')->deleteDirectory('userphotos/' . $user->id);

                $user->delete();

                return true;
            }

        } catch (\Throwable $e) {
            Log::error('Catch error while deleting user ' . $e->getFile() . $e->getLine(), [
                'user' => $user,
                'userPhoto' => $userPhoto,
                'album' => $userAlbum,
            ]);

        }

        return false;
    }
}
