<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Client\DeleteClientRequest;
use App\Http\Requests\Backend\Client\EditClientRequest;
use App\Http\Requests\Backend\Client\ManageDeactivatedRequest;
use App\Http\Requests\Backend\Client\ManageDeletedRequest;
use App\Models\Client\Client;
use App\Repositories\Backend\Client\ClientRepository;

/**
 * Class ClientStatusController.
 */
class ClientStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $clients;

    /**
     * @param ClientRepository $clients
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    /**
     * @param ManageDeactivatedRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageDeactivatedRequest $request)
    {
        return view('backend.client.deactivated');
    }

    /**
     * @param ManageDeletedRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDeletedRequest $request)
    {
        return view('backend.aclient.deleted');
    }

    /**
     * @param Client $client
     * @param $status
     * @param ManageClientRequest $request
     *
     * @return mixed
     */
    public function mark(Client $client, $status, EditClientRequest $request)
    {
        $this->clients->mark($client, $status);

        return redirect()->route($status == 1 ? 'admin.client.index' : 'admin.client.deactivated')->withFlashSuccess(trans('alerts.backend.clients.updated'));
    }

    /**
     * @param Client              $deletedClient
     * @param DeleteClientRequest $request
     *
     * @return mixed
     */
    public function delete(Client $deletedClient, DeleteClientRequest $request)
    {
        $this->clients->forceDelete($deletedClient);

        return redirect()->route('admin.client.deleted')->withFlashSuccess(trans('alerts.backend.clients.deleted_permanently'));
    }

    /**
     * @param Client              $deletedClient
     * @param DeleteClientRequest $request
     *
     * @return mixed
     */
    public function restore(Client $deletedClient, DeleteClientRequest $request)
    {
        $this->users->restore($deletedClient);

        return redirect()->route('admin.client.index')->withFlashSuccess(trans('alerts.backend.clients.restored'));
    }
}
