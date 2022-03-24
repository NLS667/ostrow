<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\Frontend\Auth\UserEventListener;
use App\Listeners\Backend\Access\User\UserAccessEventListener;
use App\Listeners\Backend\Access\Role\RoleEventListener;
use App\Listeners\Backend\Access\Permission\PermissionEventListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        'App\Events\Access\User\UserUpdated' => [
            'App\Listeners\Backend\Access\User\UserAccessEventListener@onUpdated'
        ]
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        /*
         * Frontend Subscribers
         */

        /*
         * Auth Subscribers
         */
        UserEventListener::class,

        /*
         * Backend Subscribers
         */

        /*
         * Access Subscribers
         */
        UserAccessEventListener::class,
        RoleEventListener::class,
        PermissionEventListener::class,
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
