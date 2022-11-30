<?php

namespace App\Http\Controllers\Backend\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Task\EditTaskRequest;
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
     * @param Task $task
     * @param $status
     * @param EditTaskRequest $request
     *
     * @return mixed
     */
    public function mark(Task $task, $status, EditTaskRequest $request)
    {
        $this->tasks->mark($task, $status);

        return redirect()->route('admin.task.index')->withFlashSuccess(trans('alerts.backend.tasks.updated'));
    }

}
