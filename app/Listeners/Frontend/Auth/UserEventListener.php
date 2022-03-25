<?php

namespace App\Listeners\Frontend\Auth;

use App\Events\Auth\UserLoggedIn;
use App\Events\Auth\UserLoggedOut;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        \Log::info('User Logged In: '.$event->user->first_name.' '.$event->user->last_name);

        // Generating notification
        createNotification('User Logged In: '.$event->user->first_name.' '.$event->user->last_name, 1);
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        \Log::info('User Logged Out: '.$event->user->first_name.' '.$event->user->last_name);

        // Generating notification
        createNotification('User Logged Out: '.$event->user->first_name.' '.$event->user->last_name, 1);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserLoggedIn::class,
            [UserEventListener::class, 'onLoggedIn']
        );
        $events->listen(
            UserLoggedOut::class,
            [UserEventListener::class, 'onLoggedOut']
        );
    }
}
