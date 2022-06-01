<?php

namespace App\Listeners\Backend\Service;

use App\Events\Service\ServiceCreated;
use App\Events\Service\ServiceUpdated;
use App\Events\Service\ServiceDeleted;

/**
 * Class ServiceEventListener.
 */
class ServiceEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Usługa';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->service->id)
            ->withText('trans("history.backend.services.created") <strong>'.$event->service->type->name.'</strong> dla klienta '.$event->service->client()->full_name)
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
            ->withEntity($event->service->id)
            ->withText('trans("history.backend.services.updated") <strong>'.$event->service->type->name.'</strong> dla klienta '.$event->service->client()->full_name)
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
            ->withEntity($event->service->id)
            ->withText('trans("history.backend.services.deleted") <strong>'.$event->service->type->name.'</strong> dla klienta '.$event->service->client()->full_name)
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
            ServiceUpdated::class,
            [ServiceEventListener::class, 'onUpdated']
        );
        $events->listen(
            ServiceCreated::class,
            [ServiceEventListener::class, 'onCreated']
        );
        $events->listen(
            ServiceDeleted::class,
            [ServiceEventListener::class, 'onDeleted']
        );
    }
}
