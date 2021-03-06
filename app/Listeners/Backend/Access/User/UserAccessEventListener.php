<?php

namespace App\Listeners\Backend\Access\User;

use App\Events\Access\User\UserCreated;
use App\Events\Access\User\UserUpdated;
use App\Events\Access\User\UserDeleted;
use App\Events\Access\User\UserRestored;
use App\Events\Access\User\UserPermanentlyDeleted;
use App\Events\Access\User\UserPasswordChanged;
use App\Events\Access\User\UserDeactivated;
use App\Events\Access\User\UserReactivated;

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
            ->withIcon('person_add')
            ->withClass('success')
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
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.updated") <strong>{user}</strong>')
            ->withIcon('manage_accounts')
            ->withClass('info')
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
            ->withIcon('person_remove')
            ->withClass('danger')
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
            ->withIcon('person_add_alt_1')
            ->withClass('info')
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
            ->withIcon('delete')
            ->withClass('danger')
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
            ->withIcon('sync_lock')
            ->withClass('info')
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
            ->withIcon('person_off')
            ->withClass('warning')
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
            ->withIcon('person')
            ->withClass('success')
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
        $events->listen(
            UserUpdated::class,
            [UserAccessEventListener::class, 'onUpdated']
        );
        $events->listen(
            UserCreated::class,
            [UserAccessEventListener::class, 'onCreated']
        );
        $events->listen(
            UserDeleted::class,
            [UserAccessEventListener::class, 'onDeleted']
        );
        $events->listen(
            UserRestored::class,
            [UserAccessEventListener::class, 'onRestored']
        );
        $events->listen(
            UserPermanentlyDeleted::class,
            [UserAccessEventListener::class, 'onPermanentlyDeleted']
        );
        $events->listen(
            UserPasswordChanged::class,
            [UserAccessEventListener::class, 'onPasswordChanged']
        );
        $events->listen(
            UserDeactivated::class,
            [UserAccessEventListener::class, 'onDeactivated']
        );
        $events->listen(
            UserReactivated::class,
            [UserAccessEventListener::class, 'onReactivated']
        );
    }
}
