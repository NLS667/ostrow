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
    protected $listen = [];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [       

        /*
         * Auth Subscribers
         */
        UserEventListener::class,

        /*
         * Access Subscribers
         */
        UserAccessEventListener::class,
        RoleEventListener::class,
        PermissionEventListener::class,
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
