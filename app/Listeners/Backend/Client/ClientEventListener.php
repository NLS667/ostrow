<?php

namespace App\Listeners\Backend\Client;

use App\Events\Client\ClientCreated;
use App\Events\Client\ClientUpdated;
use App\Events\Client\ClientDeleted;
use App\Events\Client\ClientRestored;
use App\Events\Client\ClientPermanentlyDeleted;
use App\Events\Client\ClientDeactivated;
use App\Events\Client\ClientReactivated;

/**
 * Class ClientEventListener.
 */
class ClientEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Klient';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.created") <strong>{client}</strong>')
            ->withIcon('person_add')
            ->withClass('success')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated(ClientUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.updated") <strong>{client}</strong>')
            ->withIcon('manage_accounts')
            ->withClass('info')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.deleted") <strong>{client}</strong>')
            ->withIcon('person_remove')
            ->withClass('danger')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.restored") <strong>{client}</strong>')
            ->withIcon('person_add_alt_1')
            ->withClass('info')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.permanently_deleted") <strong>{client}</strong>')
            ->withIcon('delete')
            ->withClass('danger')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.deactivated") <strong>{client}</strong>')
            ->withIcon('person_off')
            ->withClass('warning')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->client->id)
            ->withText('trans("history.backend.clients.reactivated") <strong>{client}</strong>')
            ->withIcon('person')
            ->withClass('success')
            ->withAssets([
                'client_link' => ['admin.client.show', $event->client->full_name, $event->client->id],
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
            ClientUpdated::class,
            [ClientEventListener::class, 'onUpdated']
        );
        $events->listen(
            ClientCreated::class,
            [ClientEventListener::class, 'onCreated']
        );
        $events->listen(
            ClientDeleted::class,
            [ClientEventListener::class, 'onDeleted']
        );
        $events->listen(
            ClientRestored::class,
            [ClientEventListener::class, 'onRestored']
        );
        $events->listen(
            ClientPermanentlyDeleted::class,
            [ClientEventListener::class, 'onPermanentlyDeleted']
        );
        $events->listen(
            ClientDeactivated::class,
            [ClientEventListener::class, 'onDeactivated']
        );
        $events->listen(
            ClientReactivated::class,
            [ClientEventListener::class, 'onReactivated']
        );
    }
}
