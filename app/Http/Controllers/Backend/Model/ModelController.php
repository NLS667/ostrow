<?php

namespace App\Http\Controllers\Backend\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Model\CreateModelRequest;
use App\Http\Requests\Backend\Model\DeleteModelRequest;
use App\Http\Requests\Backend\Model\EditModelRequest;
use App\Http\Requests\Backend\Model\ManageModelRequest;
use App\Http\Requests\Backend\Model\StoreModelRequest;
use App\Http\Requests\Backend\Model\UpdateModelRequest;
use App\Http\Responses\Backend\Model\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Model\Model;
use App\Repositories\Backend\Model\ModelRepository;

/**
 * Class ModelController.
 */
class ModelController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Model\ModelRepository
     */
    protected $model;

    /**
     * @param \App\Repositories\Backend\Model\ModelRepository $model
     */
    public function __construct(ModelRepository $model)
    {
        $this->model = $model;
    }

    /**
     * @param \App\Http\Requests\Backend\Model\ManageModelRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageModelRequest $request)
    {
        return new ViewResponse('backend.model.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Model\CreateModelRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateModelRequest $request)
    {
        return new ViewResponse('backend.model.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Model\StoreModelRequest $request
     *
     * @return mixed
     */
    public function store(StoreModelRequest $request)
    {
        $this->model->create($request->all());

        return new RedirectResponse(route('admin.model.index'), ['flash_success' => trans('alerts.backend.models.created')]);
    }

    /**
     * @param \App\Models\Model\Model                           $model
     * @param \App\Http\Requests\Backend\Model\EditModelRequest $request
     *
     * @return \App\Http\Responses\Backend\Model\EditResponse
     */
    public function edit(Model $model, EditModelRequest $request)
    {
        return new EditResponse($model);
    }

    /**
     * @param \App\Models\Access\Model\Model                      $model
     * @param \App\Http\Requests\Backend\Model\UpdateModelRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Model $model, UpdateModelRequest $request)
    {
        $this->model->update($model, $request->all());

        return new RedirectResponse(route('admin.model.index'), ['flash_success' => trans('alerts.backend.models.updated')]);
    }

    /**
     * @param \App\Models\Access\Model\Model                      $model
     * @param \App\Http\Requests\Backend\Model\DeleteModelRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Model $model, DeleteModelRequest $request)
    {
        $this->model->delete($model);

        return new RedirectResponse(route('admin.model.index'), ['flash_success' => trans('alerts.backend.models.deleted')]);
    }
}
