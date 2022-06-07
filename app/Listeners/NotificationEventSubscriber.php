<?php

namespace App\Listeners;


use App\Events\NotificationRead;
use Illuminate\Support\Facades\Log;

class NotificationEventSubscriber extends EventSubscriber
{
    /**
     *
     * Помечаем нотификацию прочитанной если ловим событие
     *
     * @param $event
     * @return void
     */
    public function handleNotificationRead($event): void
    {
        $user = $event->user;
        $user->unreadNotifications
            ->when($event->notification, function ($query) use ($event) {
                return $query->where('id', $event->notification);
            })
            ->markAsRead();

        Log::info('User read notification message', ['UserId: ' => $user->id, 'NotificationId:' => $event->notification]);
    }

    /**
     * @param $events
     * @return void
     */
    public function subscribe($events): void
    {
        $events->listen(
            NotificationRead::class,
            'App\Listeners\NotificationEventSubscriber@handleNotificationread'
        );
    }
}
