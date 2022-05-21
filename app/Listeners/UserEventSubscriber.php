<?php

namespace App\Listeners;


use App\Events\NotificationRead;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

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
        if (!$event->user->isVerified()) {
            $event->user->sendEmailVerificationNotification();
            Log::info('Verification notification message sent', ['UserId: ' => $event->user->id, 'Manual Sending:' => false]);
        }
    }

    public function handleUserVerified($event): void
    {
        Log::info('User was verified', ['UserId: ' => $event->user]);
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
