<?php

namespace App\Providers;

use App\Listeners\NotificationEventSubscriber;
use App\Listeners\UserEventSubscriber;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
//        Verified::class => [
//
//        ],
    ];

    protected $subscribe = [
        NotificationEventSubscriber::class,
        UserEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
