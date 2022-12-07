<?php

namespace App\Http\Controllers\Backend\TaskType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TaskType\ManageTaskTypeRequest;
use App\Repositories\Backend\TaskType\TaskTypeRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class TaskTypeTableController.
 */
class TaskTypeTableController extends Controller
{
    protected $taskTypes;

    /**
     * @param \App\Repositories\Backend\TaskType\TaskTypeRepository $taskTypes
     */
    public function __construct(TaskTypeRepository $taskTypes)
    {
        $this->taskTypes = $taskTypes;
    }

    /**
     * @param \App\Http\Requests\Backend\TaskType\ManageTaskTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTaskTypeRequest $request)
    {
        return Datatables::make($this->taskTypes->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('description', function ($taskType) {
                return $taskType->description;
            })
            ->addColumn('tasks', function ($taskType) {
                return $taskType->taskCount;
            })
            ->addColumn('created_at', function ($taskType) {
                return Carbon::parse($taskType->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($taskType) {
                if(isset($taskType->updated_at))
                {
                    return Carbon::parse($taskType->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($taskType) {
                return $taskType->action_buttons;
            })
            ->make(true);
    }
}
