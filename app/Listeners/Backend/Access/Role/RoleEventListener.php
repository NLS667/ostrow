<?php

namespace App\Listeners\Backend\Access\Role;

use App\Events\Access\Role\RoleCreated;
use App\Events\Access\Role\RoleUpdated;
use App\Events\Access\Role\RoleDeleted;

/**
 * Class RoleEventListener.
 */
class RoleEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Rola';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->role->id)
            ->withText('trans("history.backend.roles.created") <strong>'.$event->role->name.'</strong>')
            ->withIcon('create')
            ->withClass('success')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->role->id)
            ->withText('trans("history.backend.roles.updated") <strong>'.$event->role->name.'</strong>')
            ->withIcon('update')
            ->withClass('info')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->role->id)
            ->withText('trans("history.backend.roles.deleted") <strong>'.$event->role->name.'</strong>')
            ->withIcon('delete')
            ->withClass('danger')
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
            RoleCreated::class,
            [RoleEventListener::class, 'onCreated']
        );
        $events->listen(
            RoleUpdated::class,
            [RoleEventListener::class, 'onUpdated']
        );
        $events->listen(
            RoleDeleted::class,
            [RoleEventListener::class, 'onDeleted']
        );
    }
}
