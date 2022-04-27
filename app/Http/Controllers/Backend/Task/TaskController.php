<?php

namespace App\Http\Controllers\Backend\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Backend\Task\CreateTaskRequest;
use App\Http\Requests\Backend\Task\DeleteTaskRequest;
use App\Http\Requests\Backend\Task\EditTaskRequest;
use App\Http\Requests\Backend\Task\ManageTaskRequest;
use App\Http\Requests\Backend\Task\ShowTaskRequest;
use App\Http\Requests\Backend\Task\StoreTaskRequest;
use App\Http\Requests\Backend\Task\UpdateTaskRequest;
use App\Http\Responses\Backend\Task\CreateResponse;
use App\Http\Responses\Backend\Task\EditResponse;
use App\Http\Responses\Backend\Task\ShowResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Task\Task;
use App\Repositories\Backend\Task\TaskRepository;

/**
 * Class TaskController.
 */
class TaskController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Task\TaskRepository
     */
    protected $tasks;

    /**
     * @param \App\Repositories\Backend\Task\TaskRepository                   $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param \App\Http\Requests\Backend\Task\ManageTaskRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTaskRequest $request)
    {
        return new ViewResponse('backend.task.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Task\CreateTaskRequest $request
     *
     * @return \App\Http\Responses\Backend\Task\CreateResponse
     */
    public function create(CreateTaskRequest $request)
    {
        return new CreateResponse();
    }

    /**
     * @param \App\Http\Requests\Backend\Task\StoreTaskRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $this->tasks->create($request);

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.created')]);
    }

    /**
     * @param \App\Models\Task\Task                           $task
     * @param \App\Http\Requests\Backend\Task\ShowTaskRequest $request
     *
     * @return \App\Http\Responses\Backend\Task\ShowResponse
     */
    public function show(Task $task, ShowTaskRequest $request)
    {
        return new ShowResponse($task);
    }

    /**
     * @param \App\Models\Task\Task                           $task
     * @param \App\Http\Requests\Backend\Task\EditTaskRequest $request
     *
     * @return \App\Http\Responses\Backend\Task\EditResponse
     */
    public function edit(Task $task, EditTaskRequest $request)
    {
        return new EditResponse($task);
    }

    /**
     * @param \App\Models\Access\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\UpdateTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $this->tasks->update($task, $request);

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.updated')]);
    }

    /**
     * @param \App\Models\Access\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\DeleteTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Task $task, DeleteTaskRequest $request)
    {
        $this->clients->delete($task);

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.deleted')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $tasks = [];
        if (auth()->user()->isAdmin()) {
          $tasks = Task::whereBetween('start', [$request->start, $request->end])
                  ->with('user:id,first_name,last_name')
                  ->get();
        } else {
          $tasks = Task::whereBetween('start', [$request->start, $request->end])
                  ->where('user_id', auth()->user()->id)
                  ->get();
        }

        \Log::info(json_encode($tasks));
        return response()->json(["events" => $tasks]);
    }
}