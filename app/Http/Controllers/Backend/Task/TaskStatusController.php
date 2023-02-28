<?php

namespace App\Http\Controllers\Backend\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Task\EditTaskRequest;
use App\Http\Requests\Backend\Task\ManageTaskRequest;
use App\Models\Task\Task;
use App\Repositories\Backend\Task\TaskRepository;

/**
 * Class TaskStatusController.
 */
class TaskStatusController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * @param TaskRepository $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param ManageDeactivatedRequest $request
     *
     * @return mixed
     */
    public function getPlanned(ManageTaskRequest $request)
    {
        return view('backend.task.planned', ['q_status' => $request->q_status]);
    }

    /**
     * @param Task $task
     * @param $status
     * @param EditTaskRequest $request
     *
     * @return mixed
     */
    public function mark(Task $task, $isFinished, EditTaskRequest $request)
    {
        $this->tasks->markFinish($task, $isFinished);

        return redirect()->route('admin.task.index')->withFlashSuccess(trans('alerts.backend.tasks.updated'));
    }

    public function togglePlanned(Task $task, $isPlanned, EditTaskRequest $request)
    {
        $this->tasks->togglePlanned($task, $isPlanned);

        return redirect()->route('admin.task.planned')->withFlashSuccess(trans('alerts.backend.tasks.updated'));
    }

}
