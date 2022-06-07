<?php

namespace App\Listeners;


use App\Events\User\UserDeleted;
use App\Events\User\UserDeletionInitiated;
use App\Helpers\RoleHelper;
use App\Notifications\UserDeletedNotification;
use App\Services\AlbumService;
use App\Services\PhotoService;
use App\Services\RoleService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserEventSubscriber extends EventSubscriber
{
    /**
     *
     * Отправляем письмо с подтверждением профиля
     *
     * @param $event
     * @return void
     */
    public function handleUserRegistered($event): void
    {
        if (!$event->user->isVerified()) {
            $event->user->sendEmailVerificationNotification();
            Log::info('Verification notification message sent', ['UserId: ' => $event->user->id, 'Manual Sending:' => false]);
        }
    }

    public function handleUserVerified($event): void
    {
        Log::info('User was verified', ['UserId: ' => $event->user]);
    }

    /**
     * Событие возникающее при подтверждении удаления пользователя в админке
     *
     * @param $event
     * @return void
     */
    public function handleUserDeletionInitiated($event): void
    {
        $user = $event->user;

        $userAlbums = $user->albums()->withTrashed();
        $userPhotos = $user->photos()->withTrashed();
        $userRoles = RoleHelper::get_user_roles($user->id);

        try {
            if ($userRoles->count() > 0) {
                foreach ($userRoles as $userRole) {
                    (new RoleService())->removeRoleUser($userRole->name, $user->id);
                }
            }

            if ($userAlbums || $userPhotos) {
                foreach ($userAlbums->cursor() as $userAlbum) {
                    (new AlbumService())->deleteAlbum($userAlbum, true);
                }

                foreach ($userPhotos->cursor() as $userPhoto) {
                    (new PhotoService())->deletePhotoPermanently($userPhoto);
                }

                foreach ($userAlbums->cursor() as $deletedAlbum) {
                    (new AlbumService())->deleteAlbumPermanently($deletedAlbum);
                }

                Storage::disk('public')->deleteDirectory('userphotos/' . $user->id);

                $user->delete();
                event(new UserDeleted($user));

                Log::info("User deleted from system", [
                    'user' => $user,
                    'albumsCount' => $userAlbums,
                    'photosCount' => $userPhotos
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Catch error while deleting user ' . $e->getFile() . $e->getLine(), [
                'user' => $user,
                'userPhoto' => $userPhoto,
                'album' => $userAlbum,
            ]);

        }
    }

    /**
     * Событие после удаления пользователя
     *
     * @param $event
     * @return void
     */
    public function handleUserDeleted($event): void
    {
        $event->user->notify(new UserDeletedNotification());
    }

    /**
     * @param $events
     * @return void
     */
    public function subscribe($events): void
    {
        $events->listen(
            Registered::class,
            'App\Listeners\UserEventSubscriber@handleUserRegistered'
        );

        $events->listen(
            Verified::class,
            'App\Listeners\UserEventSubscriber@handleUserVerified'
        );

        $events->listen(
            UserDeletionInitiated::class,
            'App\Listeners\UserEventSubscriber@handleUserDeletionInitiated'
        );

        $events->listen(
            UserDeleted::class,
            'App\Listeners\UserEventSubscriber@handleUserDeleted'
        );

    }
}
