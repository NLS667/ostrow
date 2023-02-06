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
use App\Http\Requests\Backend\Task\RaportTaskRequest;
use App\Http\Requests\Backend\Task\StoreRaportRequest;
use App\Http\Responses\Backend\Task\CreateResponse;
use App\Http\Responses\Backend\Task\EditResponse;
use App\Http\Responses\Backend\Task\ShowResponse;
use App\Http\Responses\Backend\Task\RaportResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Task\Task;
use App\Repositories\Backend\Task\TaskRepository;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Repositories\Backend\TaskType\TaskTypeRepository;
use App\Models\Device\Device;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function __construct(TaskRepository $tasks, ServiceRepository $services, UserRepository $users, TaskTypeRepository $types)
    {
        $this->services = $services;
        $this->users = $users;
        $this->tasks = $tasks;
        $this->types = $types;
    }

    /**
     * @param \App\Http\Requests\Backend\Task\ManageTaskRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTaskRequest $request)
    {
        return new ViewResponse('backend.task.index', ['q_status' => $request->q_status]);
    }

    /**
     * @param \App\Http\Requests\Backend\Task\CreateTaskRequest $request
     *
     * @return \App\Http\Responses\Backend\Task\CreateResponse
     */
    public function create(CreateTaskRequest $request)
    {
        $services = $this->services->getAll();
        $users = $this->users->getAll();
        $types = $this->types->getAll();
        return new CreateResponse($services, $users, $types);
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
        $services = $this->services->getAll();
        $users = $this->users->getAll();
        $types = $this->types->getAll();
        return new EditResponse($task, $services, $users, $types);
    }

    /**
     * @param \App\Models\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\UpdateTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $this->tasks->update($task, $request->all());

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.updated')]);
    }

    /**
     * @param \App\Models\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\DeleteTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Task $task, DeleteTaskRequest $request)
    {
        $this->tasks->delete($task);

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.deleted')]);
    }

    /**
     * @param \App\Models\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\UpdateTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function get_raport(Task $task, RaportTaskRequest $request)
    {
        $service = $this->services->find($task->service_id);
        $client = $service->client;
        $devices = Device::where('service_id', $task->service_id)->get();

        $data['service'] = $service;
        $data['client'] = $client;
        $data['devices'] = $devices;

        Pdf::setOption(['dpi' => 150, 'default_media_type' => 'screen']);
        $pdf = Pdf::loadView('backend.task.raports.template', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('report.pdf');

        //return new ViewResponse('backend.task.raports.template', ['data' => $data]);
    }

    /**
     * @param \App\Models\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\UpdateTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function create_raport(Task $task, RaportTaskRequest $request)
    {
        $service = $this->services->find($task->service_id);
        $client = $service->client;
        $devices = Device::where('service_id', $task->service_id)->get();

        return new RaportResponse($task, $service, $client, $devices);
    }

    /**
     * @param \App\Models\Task\Task                             $task
     * @param \App\Http\Requests\Backend\Task\UpdateTaskRequest        $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store_raport( StoreRaportRequest $request)
    {
        $validated = $request->validated();

        $this->tasks->create_raport($request);

        return new RedirectResponse(route('admin.task.index'), ['flash_success' => trans('alerts.backend.tasks.raport_created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        //$tasks = [];
        
        if (auth()->user()->isAdmin()) {
          $tasks = Task::whereBetween('start', [$request->start, $request->end])
                  ->with('assignee:id,first_name,last_name')
                  ->with('service.client')
                  ->get();
        } else {
          $tasks = Task::whereBetween('start', [$request->start, $request->end])
                  ->where('assignee_id', auth()->user()->id)
                  ->with('assignee:id,first_name,last_name')
                  ->with('service.client')
                  ->get();
        }

        $tasks->makeHidden(['created_at', 'updated_at','created_by','updated_by']);
        
        return response()->json($tasks);
    }

    public function updateDates(Request $request)
    { 
        $data = $request->all();
        $taskToUpdate = $this->tasks->find($data['data']['id']);

        $this->tasks->update($taskToUpdate, $data['data']);
    }
}
