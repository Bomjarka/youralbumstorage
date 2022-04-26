<?php

namespace App\Listeners;


use App\Events\NotificationRead;

class NotificationEventSubscriber
{
    public function handleNotificationread($event)
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
