<?php

namespace App\Listeners;


use App\Events\NotificationRead;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;

class UserEventSubscriber
{
    /**
     *
     * Помечаем нотификацию прочитанной если ловим событие
     *
     * @param $event
     * @return void
     */
    public function handleUserRegistered($event): void
    {
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }

    public function handleUserVerified($event): void
    {
       throw new \Exception('User was verified');
    }

    public function subscribe($events)
    {
        $events->listen(
            Registered::class,
            'App\Listeners\UserEventSubscriber@handleUserRegistered'
        );

        $events->listen(
          Verified::class,
            'App\Listeners\UserEventSubscriber@handleUserVerified'
        );
    }
}
