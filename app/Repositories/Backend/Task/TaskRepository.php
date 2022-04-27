<?php

namespace App\Repositories\Backend\Task;

use App\Events\Task\TaskCreated;
use App\Events\Task\TaskDeleted;
use App\Events\Task\TaskUpdated;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Task\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ServiceRepository.
 */
class TaskRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Task::class;

    /**
     * @var Task Model
     */
    protected $model;

    
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable($status = 1, $trashed = false)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->leftJoin('service_client', 'service_client.client_id', '=', 'clients.id')
            ->leftJoin('services', 'service_client.service_id', '=', 'services.id')
            ->select([
                config('task.tasks_table').'.id',
                config('task.tasks_table').'.title',
                config('task.tasks_table').'.description',
                config('task.tasks_table').'.created_at',
                config('task.tasks_table').'.updated_at',
            ]);

        if ($trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        return $dataTableQuery;
    }

    /**
     * Create Task.
     *
     * @param Model $request
     */
    public function create($request)
    {
        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($client, $data, $services, $tasks) {
            if ($task->save()) {

                //Client Created, Validate Roles
                //if (!count($roles)) {
                //    throw new GeneralException(trans('exceptions.backend.access.users.role_needed_create'));
                //}

                //Attach new roles
                //$client->attachServices($services);

                // Attach New Permissions
                //$client->attachTasks($tasks);

                //Send confirmation email if requested and account approval is off
                //if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                 //   $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                //}

                \Event::dispatch(new TaskCreated($task));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.tasks.create_error'));
        });
    }

    /**
     * @param Model $task
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($task, $request)
    {
        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');

        DB::transaction(function () use ($client, $data, $services, $tasks) {
            if ($task->update($data)) {
                
                $task->save();

                event(new TaskUpdated($task));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.tasks.update_error'));
        });
    }

    /**
     * Delete Task.
     *
     * @param Model $task
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($task)
    {
        if ($task->delete()) {
            event(new TaskDeleted($task));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.tasks.delete_error'));
    }

    /**
     * @param $client
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark($task, $status)
    {
        $task->status = $status;

        switch ($status) {
            case 0:
                event(new TaskSoon($task));
            break;

            case 1:
                event(new TaskPending($task));
            break;

            case 2:
                event(new TaskFinished($task));
            break;

            case 3:
                event(new TaskLate($task));
            break;
        }

        if ($task->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.tasks.mark_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createTaskStub($input)
    {
        $task = self::MODEL;
        $task = new $task();
        $task->title = $input['title'];
        $task->last_name = $input['last_name'];
        $task->email = $input['email'];
        $task->status = isset($input['status']) ? $input['status'] : 0;
        $task->created_by = access()->user()->id;

        return $task;
    }

    /**
     * @param $permissions
     * @param string $by
     *
     * @return mixed
     */
    public function getByPermission($permissions, $by = 'name')
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        return $this->query()->whereHas('roles.permissions', function ($query) use ($permissions, $by) {
            $query->whereIn('permissions.'.$by, $permissions);
        })->get();
    }

    /**
     * @param $roles
     * @param string $by
     *
     * @return mixed
     */
    public function getByRole($roles, $by = 'name')
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        return $this->query()->whereHas('roles', function ($query) use ($roles, $by) {
            $query->whereIn('roles.'.$by, $roles);
        })->get();
    }
}
