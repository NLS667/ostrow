<?php

namespace App\Listeners\Backend\Task;

use App\Events\Task\TaskCreated;
use App\Events\Task\TaskUpdated;
use App\Events\Task\TaskDeleted;

/**
 * Class TaskEventListener.
 */
class TaskEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Zadanie';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.created") <strong>{task}</strong>')
            ->withIcon('person_add')
            ->withClass('success')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated(ClientUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.updated") <strong>{task}</strong>')
            ->withIcon('manage_accounts')
            ->withClass('info')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.deleted") <strong>{task}</strong>')
            ->withIcon('person_remove')
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
            TaskUpdated::class,
            [TaskEventListener::class, 'onUpdated']
        );
        $events->listen(
            TaskCreated::class,
            [TaskEventListener::class, 'onCreated']
        );
        $events->listen(
            TaskDeleted::class,
            [TaskEventListener::class, 'onDeleted']
        );
    }
}
