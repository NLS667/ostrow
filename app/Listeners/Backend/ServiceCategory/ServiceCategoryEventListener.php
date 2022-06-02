<?php

namespace App\Listeners\Backend\ServiceCategory;

use App\Events\ServiceCategory\ServiceCategoryCreated;
use App\Events\ServiceCategory\ServiceCategoryUpdated;
use App\Events\ServiceCategory\ServiceCategoryDeleted;

/**
 * Class ServiceCategoryEventListener.
 */
class ServiceCategoryEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Kategoria Usług';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->serviceCategory->id)
            ->withText('trans("history.backend.services.category.created") <strong>'.$event->serviceCategory->name.'</strong>')
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
            ->withEntity($event->serviceCategory->id)
            ->withText('trans("history.backend.services.category.updated") <strong>'.$event->serviceCategory->name.'</strong>')
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
            ->withEntity($event->serviceCategory->id)
            ->withText('trans("history.backend.services.category.deleted") <strong>'.$event->serviceCategory->name.'</strong>')
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
            ServiceCategoryUpdated::class,
            [ServiceCategoryEventListener::class, 'onUpdated']
        );
        $events->listen(
            ServiceCategoryCreated::class,
            [ServiceCategoryEventListener::class, 'onCreated']
        );
        $events->listen(
            ServiceCategoryDeleted::class,
            [ServiceCategoryEventListener::class, 'onDeleted']
        );
    }
}
