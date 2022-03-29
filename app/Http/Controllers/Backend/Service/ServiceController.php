<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Service\CreateServiceRequest;
use App\Http\Requests\Backend\Service\DeleteServiceRequest;
use App\Http\Requests\Backend\Service\EditServiceRequest;
use App\Http\Requests\Backend\Service\ManageServiceRequest;
use App\Http\Requests\Backend\Service\StoreServiceRequest;
use App\Http\Requests\Backend\Service\UpdateServiceRequest;
use App\Http\Responses\Backend\Service\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Service\Service;
use App\Repositories\Backend\Service\ServiceRepository;

/**
 * Class ServiceController.
 */
class ServiceController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Service\ServiceRepository
     */
    protected $service;

    /**
     * @param \App\Repositories\Backend\Service\ServiceRepository $service
     */
    public function __construct(ServiceRepository $service)
    {
        $this->service = $service;
    }

    /**
     * @param \App\Http\Requests\Backend\Service\ManageServiceRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageServiceRequest $request)
    {
        return new ViewResponse('backend.service.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Service\CreateServiceRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateServiceRequest $request)
    {
        return new ViewResponse('backend.service.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Service\StoreServiceRequest $request
     *
     * @return mixed
     */
    public function store(StoreServiceRequest $request)
    {
        $this->service->create($request->all());

        return new RedirectResponse(route('admin.service.index'), ['flash_success' => trans('alerts.backend.services.created')]);
    }

    /**
     * @param \App\Models\Service\Service                           $service
     * @param \App\Http\Requests\Backend\Service\EditServiceRequest $request
     *
     * @return \App\Http\Responses\Backend\Service\EditResponse
     */
    public function edit(Service $service, EditServiceRequest $request)
    {
        return new EditResponse($service);
    }

    /**
     * @param \App\Models\Access\Service\Service                      $service
     * @param \App\Http\Requests\Backend\Service\UpdateServiceRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Service $service, UpdateServiceRequest $request)
    {
        $this->service->update($service, $request->all());

        return new RedirectResponse(route('admin.service.index'), ['flash_success' => trans('alerts.backend.services.updated')]);
    }

    /**
     * @param \App\Models\Access\Service\Service                      $service
     * @param \App\Http\Requests\Backend\Service\DeleteServiceRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Service $service, DeleteServiceRequest $request)
    {
        $this->service->delete($service);

        return new RedirectResponse(route('admin.service.index'), ['flash_success' => trans('alerts.backend.services.deleted')]);
    }
}
