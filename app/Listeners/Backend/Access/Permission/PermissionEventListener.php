<?php

namespace App\Listeners\Backend\Access\Permission;

/**
 * Class PermissionEventListener.
 */
class PermissionEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Uprawnienie';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.created") <strong>'.$event->permission->name.'</strong>')
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
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.updated") <strong>'.$event->permission->name.'</strong>')
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
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.deleted") <strong>'.$event->permission->name.'</strong>')
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
            \App\Events\Access\Permission\PermissionCreated::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Access\Permission\PermissionUpdated::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Access\Permission\PermissionDeleted::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onDeleted'
        );
    }
}
