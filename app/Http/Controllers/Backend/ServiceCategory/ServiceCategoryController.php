<?php

namespace App\Http\Controllers\Backend\ServiceCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ServiceCategory\CreateServiceCatRequest;
use App\Http\Requests\Backend\ServiceCategory\DeleteServiceCatRequest;
use App\Http\Requests\Backend\ServiceCategory\EditServiceCatRequest;
use App\Http\Requests\Backend\ServiceCategory\ManageServiceCatRequest;
use App\Http\Requests\Backend\ServiceCategory\StoreServiceCatRequest;
use App\Http\Requests\Backend\ServiceCategory\UpdateServiceCatRequest;
use App\Http\Responses\Backend\ServiceCategory\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\ServiceCategory\ServiceCategory;
use App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository;

/**
 * Class ServiceCategoryController.
 */
class ServiceCategoryController extends Controller
{
    /**
     * @var \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository
     */
    protected $serviceCategory;

    /**
     * @param \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository $serviceCategory
     */
    public function __construct(ServiceCategoryRepository $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }

    /**
     * @param \App\Http\Requests\Backend\ServiceCategory\ManageServiceCatRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageServiceCatRequest $request)
    {
        return new ViewResponse('backend.serviceCategory.index');
    }

    /**
     * @param \App\Http\Requests\Backend\ServiceCategory\CreateServiceCatRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateServiceCatRequest $request)
    {
        return new ViewResponse('backend.serviceCategory.create');
    }

    /**
     * @param \App\Http\Requests\Backend\ServiceCategory\StoreServiceRequest $request
     *
     * @return mixed
     */
    public function store(StoreServiceRequest $request)
    {
        $this->serviceCategory->create($request->all());

        return new RedirectResponse(route('admin.serviceCategory.index'), ['flash_success' => trans('alerts.backend.serviceCategory.created')]);
    }

    /**
     * @param \App\Models\ServiceCategory\ServiceCategory                           $serviceCategory
     * @param \App\Http\Requests\Backend\ServiceCategory\EditServiceCatRequest      $request
     *
     * @return \App\Http\Responses\Backend\ServiceCategory\EditResponse
     */
    public function edit(ServiceCategory $serviceCategory, EditServiceCatRequest $request)
    {
        return new EditResponse($serviceCategory);
    }

    /**
     * @param \App\Models\Access\ServiceCategory\ServiceCategory                      $serviceCategory
     * @param \App\Http\Requests\Backend\ServiceCategory\UpdateServiceCatRequest      $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ServiceCategory $serviceCategory, UpdateServiceCatRequest $request)
    {
        $this->serviceCategory->update($serviceCategory, $request->all());

        return new RedirectResponse(route('admin.serviceCategory.index'), ['flash_success' => trans('alerts.backend.serviceCategory.updated')]);
    }

    /**
     * @param \App\Models\Access\ServiceCategory\ServiceCategory                      $serviceCategory
     * @param \App\Http\Requests\Backend\ServiceCategory\DeleteServiceCatRequest      $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ServiceCategory $serviceCategory, DeleteServiceCatRequest $request)
    {
        $this->serviceCategory->delete($serviceCategory);

        return new RedirectResponse(route('admin.serviceCategory.index'), ['flash_success' => trans('alerts.backend.serviceCategory.deleted')]);
    }
}
