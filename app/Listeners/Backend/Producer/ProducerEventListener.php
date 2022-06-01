<?php

namespace App\Listeners\Backend\Producer;

use App\Events\Producer\ProducerCreated;
use App\Events\Producer\ProducerUpdated;
use App\Events\Producer\ProducerDeleted;

/**
 * Class ProducerEventListener.
 */
class ProducerEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Producent';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->producer->id)
            ->withText('trans("history.backend.producers.created") <strong>{producer}</strong>')
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
            ->withEntity($event->producer->id)
            ->withText('trans("history.backend.producers.updated") <strong>{producer}</strong>')
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
            ->withEntity($event->producer->id)
            ->withText('trans("history.backend.producers.deleted") <strong>{producer}</strong>')
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
            ProducerUpdated::class,
            [ProducerEventListener::class, 'onUpdated']
        );
        $events->listen(
            ProducerCreated::class,
            [ProducerEventListener::class, 'onCreated']
        );
        $events->listen(
            ProducerDeleted::class,
            [ProducerEventListener::class, 'onDeleted']
        );
    }
}
