<?php

namespace App\Repositories\Backend\TaskType;

use App\Events\TaskType\TaskTypeCreated;
use App\Events\TaskType\TaskTypeDeleted;
use App\Events\TaskType\TaskTypeUpdated;
use App\Exceptions\GeneralException;
use App\Models\TaskType\TaskType;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class TaskTypeRepository.
 */
class TaskTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = TaskType::class;

    /**
     * @var TaskType Model
     */
    protected $model;

    /**
     * @var TaskTypeRepository
     */
    protected $taskType;

    /**
     * @param TaskTypeRepository $taskType
     */
    public function __construct(TaskType $model)
    {
        $this->model = $model;
        //$this->service = $service;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        return $this->query()
            ->leftJoin('tasks', 'tasks.type_id', '=', 'task_types.id')
            ->select([
                'task_types.id',
                'task_types.name',
                'task_types.description',
                DB::raw('(SELECT COUNT(tasks.id) FROM tasks WHERE tasks.type_id == task_types.id AND tasks.isFinished == 0) AS taskCount'),
                'task_types.created_at',
                'task_types.updated_at',
            ])
            ->groupBy('task_types.id');
    }

    /**
     * Create TaskType.
     *
     * @param $request
     */
    public function create($request)
    {
        if ($this->query()->where('name', $request['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.task_type.already_exists'));
        }

        DB::transaction(function () use ($request) {

            $taskType = self::MODEL;
            $taskType = new $taskType();
            $taskType->name = $request['name'];
            $taskType->description = $request['description'];

            $taskType->created_by = access()->user()->id;

            if ($taskType->save()) {

                event(new TaskTypeCreated($taskType));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.task_type.create_error'));
        });
    }

    /**
     * Update Task Type
     * 
     * @param Model $taskType
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($taskType, $request)
    {
        DB::transaction(function () use ($taskType, $request) {
            if ($taskType->update($request)) {
                
                $taskType->save();

                event(new TaskTypeUpdated($taskType));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.task_type.update_error'));
        });
    }

    /**
     * Delete Task Type.
     *
     * @param Model $taskType
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($taskType)
    {
        if ($taskType->delete()) {
            event(new ServiceCategoryDeleted($taskType));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.task_type.delete_error'));
    }
}
