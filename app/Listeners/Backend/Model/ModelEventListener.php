<?php

namespace App\Listeners\Backend\Model;

use App\Events\Model\ModelCreated;
use App\Events\Model\ModelUpdated;
use App\Events\Model\ModelDeleted;

/**
 * Class ModelEventListener.
 */
class ModelEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Model';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->model->id)
            ->withText('trans("history.backend.models.created") <strong>'.$event->model->name.'</strong>')
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
            ->withEntity($event->model->id)
            ->withText('trans("history.backend.models.updated") <strong>'.$event->model->name.'</strong>')
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
            ->withEntity($event->model->id)
            ->withText('trans("history.backend.models.deleted") <strong>'.$event->model->name.'</strong>')
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
            ModelUpdated::class,
            [ModelEventListener::class, 'onUpdated']
        );
        $events->listen(
            ModelCreated::class,
            [ModelEventListener::class, 'onCreated']
        );
        $events->listen(
            ModelDeleted::class,
            [ModelEventListener::class, 'onDeleted']
        );
    }
}
