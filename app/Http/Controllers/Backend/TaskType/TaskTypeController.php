<?php

namespace App\Http\Controllers\Backend\TaskType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TaskType\CreateTaskTypeRequest;
use App\Http\Requests\Backend\TaskType\DeleteTaskTypeRequest;
use App\Http\Requests\Backend\TaskType\EditTaskTypeRequest;
use App\Http\Requests\Backend\TaskType\ManageTaskTypeRequest;
use App\Http\Requests\Backend\TaskType\StoreTaskTypeRequest;
use App\Http\Requests\Backend\TaskType\UpdateTaskTypeRequest;
use App\Http\Responses\Backend\TaskType\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\TaskType\TaskType;
use App\Repositories\Backend\TaskType\TaskTypeRepository;

/**
 * Class TaskTypeController.
 */
class TaskTypeController extends Controller
{
    /**
     * @var \App\Repositories\Backend\TaskType\TaskTypeRepository
     */
    protected $taskType;

    /**
     * @param \App\Repositories\Backend\TaskType\TaskTypeRepository $taskType
     */
    public function __construct(TaskTypeRepository $taskType)
    {
        $this->taskType = $taskType;
    }

    /**
     * @param \App\Http\Requests\Backend\TaskType\ManageTaskTypeRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTaskTypeRequest $request)
    {
        return new ViewResponse('backend.taskType.index');
    }

    /**
     * @param \App\Http\Requests\Backend\TaskType\CreateTaskTypeRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateTaskTypeRequest $request)
    {
        return new ViewResponse('backend.taskType.create');
    }

    /**
     * @param \App\Http\Requests\Backend\TaskType\StoreTaskTypeRequest $request
     *
     * @return mixed
     */
    public function store(StoreTaskTypeRequest $request)
    {
        $this->taskType->create($request->all());

        return new RedirectResponse(route('admin.taskType.index'), ['flash_success' => trans('alerts.backend.taskType.created')]);
    }

    /**
     * @param \App\Models\TaskType\TaskType                                 $taskType
     * @param \App\Http\Requests\Backend\TaskType\EditTaskTypeRequest       $request
     *
     * @return \App\Http\Responses\Backend\TaskType\EditResponse
     */
    public function edit(TaskType $taskType, EditTaskTypeRequest $request)
    {
        return new EditResponse($taskType);
    }

    /**
     * @param \App\Models\Access\TaskType\TaskType                          $taskType
     * @param \App\Http\Requests\Backend\TaskType\UpdateTaskTypeRequest     $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(TaskType $taskType, UpdateTaskTypeRequest $request)
    {
        $this->taskType->update($taskType, $request->all());

        return new RedirectResponse(route('admin.taskType.index'), ['flash_success' => trans('alerts.backend.taskType.updated')]);
    }

    /**
     * @param \App\Models\Access\TaskType\TaskType                          $taskType
     * @param \App\Http\Requests\Backend\TaskType\DeleteTaskTypeRequest     $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(TaskType $taskType, DeleteTaskTypeRequest $request)
    {
        $this->taskType->delete($taskType);

        return new RedirectResponse(route('admin.taskType.index'), ['flash_success' => trans('alerts.backend.taskType.deleted')]);
    }
}
