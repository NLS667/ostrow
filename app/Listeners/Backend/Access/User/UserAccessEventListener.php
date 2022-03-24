<?php

namespace App\Listeners\Backend\Access\User;

use App\Events\Backend\Access\User\UserCreated;
use App\Events\Backend\Access\User\UserUpdated;
use App\Events\Backend\Access\User\UserDeleted;
use App\Events\Backend\Access\User\UserRestored;
use App\Events\Backend\Access\User\UserPermanentlyDeleted;
use App\Events\Backend\Access\User\UserPasswordChanged;
use App\Events\Backend\Access\User\UserDeactivated;
use App\Events\Backend\Access\User\UserReactivated;

/**
 * Class UserAccessEventListener.
 */
class UserAccessEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Użytkownik';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.created") <strong>{user}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated(UserUpdated $event)
    {
         \Log::error('User Updated: '.$event->user->first_name);
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.updated") <strong>{user}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->first_name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.restored") <strong>{user}</strong>')
            ->withIcon('refresh')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.permanently_deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.changed_password") <strong>{user}</strong>')
            ->withIcon('lock')
            ->withClass('bg-blue')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.deactivated") <strong>{user}</strong>')
            ->withIcon('times')
            ->withClass('bg-yellow')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.reactivated") <strong>{user}</strong>')
            ->withIcon('check')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        return [
            UserCreated::class => 'onCreated',
            UserUpdated::class => 'onUpdated',
            UserDeleted::class => 'onDeleted',
            UserRestored::class => 'onRestored',
            UserPermanentlyDeleted::class => 'onPermanentlyDeleted',
            UserPasswordChanged::class => 'onPasswordChanged',
            UserDeactivated::class => 'onDeactivated',
            UserReactivated::class => 'onReactivated',
        ];
    }
}
