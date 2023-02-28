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
            ->withText('trans("history.backend.tasks.created")')
            ->withIcon('person_add')
            ->withClass('success')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated(TaskUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.updated")')
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
            ->withText('trans("history.backend.tasks.deleted")')
            ->withIcon('person_remove')
            ->withClass('danger')
            ->log();
    }

    /**
     * @param $event
     */
    public function onFinished($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.finished")')
            ->withIcon('done_all')
            ->withClass('success')
            ->log();
    }

    /**
     * @param $event
     */
    public function onPlanned($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.planned")')
            ->withIcon('event_repeat')
            ->withClass('primary')
            ->log();
    }

    /**
     * @param $event
     */
    public function onActivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->task->id)
            ->withText('trans("history.backend.tasks.activated")')
            ->withIcon('event_available')
            ->withClass('primary')
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
        $events->listen(
            TaskFinished::class,
            [TaskEventListener::class, 'onFinished']
        );
        $events->listen(
            TaskPlanned::class,
            [TaskEventListener::class, 'onPlanned']
        );
        $events->listen(
            TaskActivated::class,
            [TaskEventListener::class, 'onActivated']
        );
    }
}
