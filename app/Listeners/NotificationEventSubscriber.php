<?php

namespace App\Listeners;


use App\Events\NotificationRead;

class NotificationEventSubscriber
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
    }

    public function subscribe($events)
    {
        $events->listen(
            NotificationRead::class,
            'App\Listeners\NotificationEventSubscriber@handleNotificationread'
        );
    }
}
