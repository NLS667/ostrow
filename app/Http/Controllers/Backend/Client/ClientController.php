<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Client\CreateClientRequest;
use App\Http\Requests\Backend\Client\DeleteClientRequest;
use App\Http\Requests\Backend\Client\EditClientRequest;
use App\Http\Requests\Backend\Client\ManageClientRequest;
use App\Http\Requests\Backend\Client\ShowClientRequest;
use App\Http\Requests\Backend\Client\StoreClientRequest;
use App\Http\Requests\Backend\Client\UpdateClientRequest;
use App\Http\Responses\Backend\Client\CreateResponse;
use App\Http\Responses\Backend\Client\EditResponse;
use App\Http\Responses\Backend\Client\ShowResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Client\Client;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Repositories\Backend\Client\ClientRepository;

/**
 * Class ClientController.
 */
class ClientController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Client\ClientRepository
     */
    protected $clients;

    /**
     * @var \App\Repositories\Backend\Service\ServiceRepository
     */
    protected $services;

    /**
     * @param \App\Repositories\Backend\Client\ClientRepository $clients
     * @param \App\Repositories\Backend\Service\ServiceRepository $services
     */
    public function __construct(ClientRepository $clients, ServiceRepository $services)
    {
        $this->clients = $clients;
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Client\ManageClientRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageClientRequest $request)
    {
        return new ViewResponse('backend.client.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Client\CreateClientRequest $request
     *
     * @return \App\Http\Responses\Backend\Client\CreateResponse
     */
    public function create(CreateClientRequest $request)
    {
        $services = $this->services->getAll();

        return new CreateResponse($services);
    }

    /**
     * @param \App\Http\Requests\Backend\Client\StoreClientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

        $this->clients->create($request);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.clients.created')]);
    }

    /**
     * @param \App\Models\Client\Client                           $client
     * @param \App\Http\Requests\Backend\Client\ShowClientRequest $request
     *
     * @return \App\Http\Responses\Backend\Client\ShowResponse
     */
    public function show(Client $client, ShowClientRequest $request)
    {
        return new ShowResponse($client);
    }

    /**
     * @param \App\Models\Client\Client                           $client
     * @param \App\Http\Requests\Backend\Client\EditClientRequest $request
     *
     * @return \App\Http\Responses\Backend\Client\EditResponse
     */
    public function edit(Client $client, EditClientRequest $request)
    {
        $services = $this->services->getAll();
        $tasks = Task::getSelectData('name');

        return new EditResponse($client, $services, $tasks);
    }

    /**
     * @param \App\Models\Access\Client\Client                             $client
     * @param \App\Http\Requests\Backend\Client\UpdateClientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Client $client, UpdateClientRequest $request)
    {
        $this->clients->update($client, $request);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.clients.updated')]);
    }

    /**
     * @param \App\Models\Access\Client\Client                             $client
     * @param \App\Http\Requests\Backend\Client\DeleteClientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Client $client, DeleteClientRequest $request)
    {
        $this->clients->delete($client);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.clients.deleted')]);
    }

    /**
     * @param \App\Models\Access\Client\Client                             $client
     * @param \App\Http\Requests\Backend\Client\DeleteClientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function getServiceForm()
    {
        return view('backend.includes.partials.client-add-service');
    }
}
