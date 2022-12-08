<?php

namespace App\Http\Controllers\Backend\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Task\ManageTaskRequest;
use App\Repositories\Backend\Task\TaskRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class TaskTableController.
 */
class TaskTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Task\TaskRepository
     */
    protected $tasks;

    /**
     * @param \App\Repositories\Backend\Task\TaskRepository $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param \App\Http\Requests\Backend\Task\ManageTaskRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTaskRequest $request)
    {
        return Datatables::make($this->tasks->getForDataTable())
            ->escapeColumns('id')
            ->addColumn('assignee', function ($task) {
                return $task->assignee_name;
            })
            ->addColumn('type', function ($task) {
                return $task->type;
            })
            ->addColumn('service', function ($task) {
                return $task->title;
            })
            ->addColumn('status', function ($task) {
                return $task->status;
            })
            ->editColumn('start', function ($task) {
                return Carbon::parse($task->start)->toDateTimeString();
            })
            ->editColumn('end', function ($task) {
                return Carbon::parse($task->end)->toDateTimeString();
            })
            ->addColumn('created_at', function ($task) {
                return Carbon::parse($task->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($task) {
                if(isset($task->updated_at)){
                    return Carbon::parse($task->updated_at)->toDateString();
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($task) {
                return $task->action_buttons;
            })
            ->make(true);
    }
}
