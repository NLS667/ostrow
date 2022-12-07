<?php

namespace App\Listeners\Backend\TaskType;

use App\Events\TaskType\TaskTypeCreated;
use App\Events\TaskType\TaskTypeUpdated;
use App\Events\TaskType\TaskTypeDeleted;

/**
 * Class TaskTypeEventListener.
 */
class TaskTypeEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Rodzaj Zadania';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->taskType->id)
            ->withText('trans("history.backend.tasks.type.created") <strong>'.$event->taskType->name.'</strong>')
            ->withIcon('person_add')
            ->withClass('success')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated(ServiceCategoryUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->taskType->id)
            ->withText('trans("history.backend.tasks.type.updated") <strong>'.$event->taskType->name.'</strong>')
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
            ->withEntity($event->taskType->id)
            ->withText('trans("history.backend.tasks.type.deleted") <strong>'.$event->taskType->name.'</strong>')
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
            TaskTypeUpdated::class,
            [TaskTypeEventListener::class, 'onUpdated']
        );
        $events->listen(
            TaskTypeCreated::class,
            [TaskTypeEventListener::class, 'onCreated']
        );
        $events->listen(
            TaskTypeDeleted::class,
            [TaskTypeEventListener::class, 'onDeleted']
        );
    }
}
