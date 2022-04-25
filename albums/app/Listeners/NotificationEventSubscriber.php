<?php

namespace App\Listeners;


use App\Events\VerificationNotificationRead;

class NotificationEventSubscriber
{
    public function handleVerificationNotificationread($event)
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
            VerificationNotificationRead::class,
            'App\Listeners\NotificationEventSubscriber@handleVerificationNotificationread'
        );
    }
}
