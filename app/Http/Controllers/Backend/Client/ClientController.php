<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Backend\Client\CreateClientRequest;
use App\Http\Requests\Backend\Client\DeleteClientRequest;
use App\Http\Requests\Backend\Client\EditClientRequest;
use App\Http\Requests\Backend\Client\ManageClientRequest;
use App\Http\Requests\Backend\Client\ShowClientRequest;
use App\Http\Requests\Backend\Client\StoreClientRequest;
use App\Http\Requests\Backend\Client\UpdateClientRequest;
use App\Http\Requests\Backend\Client\ClientCoordsRequest;
use App\Http\Responses\Backend\Client\CreateResponse;
use App\Http\Responses\Backend\Client\EditResponse;
use App\Http\Responses\Backend\Client\ShowResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Client\Client;
use App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository;
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
     * @var \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository
     */
    protected $serviceCategories;

    /**
     * @var \App\Repositories\Backend\Service\ServiceRepository
     */
    protected $services;

    /**
     * @param \App\Repositories\Backend\Client\ClientRepository                   $clients
     * @param \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository $serviceCategories
     * @param \App\Repositories\Backend\Service\ServiceRepository                 $services
     */
    public function __construct(ClientRepository $clients, ServiceCategoryRepository $serviceCategories, ServiceRepository $services)
    {
        $this->clients = $clients;
        $this->serviceCategories = $serviceCategories;
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
        $serviceCategories = $this->serviceCategories->getAll();

        return new CreateResponse($serviceCategories);
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
        $services = $this->services->query()->where('client_id', $client->id);
        $serviceCatIds = [];
        foreach($services as $service){
            $serviceCatIds[] = $service->service_cat_id;
        }
        $serviceCategories = $this->serviceCategories->query()->where('id', $serviceCatIds);
        return new ShowResponse($client, $serviceCategories);
    }

    /**
     * @param \App\Models\Client\Client                           $client
     * @param \App\Http\Requests\Backend\Client\EditClientRequest $request
     *
     * @return \App\Http\Responses\Backend\Client\EditResponse
     */
    public function edit(Client $client, EditClientRequest $request)
    {
        $serviceCategories = $this->serviceCategories->getAll();

        return new EditResponse($client, $serviceCategories);
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

    public function getCoordinates(Request $request){
        $address = $request->get('data');

        $response = Http::get("https://nominatim.openstreetmap.org/search?".$address."&limit=1&format=json&addressdetails=1");
        return $response; 
    }
}
