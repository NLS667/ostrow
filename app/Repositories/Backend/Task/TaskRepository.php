<?php

namespace App\Repositories\Backend\Task;

use App\Events\Task\TaskCreated;
use App\Events\Task\TaskDeleted;
use App\Events\Task\TaskUpdated;
use App\Events\Task\TaskFinished;
use App\Events\Task\TaskRestarted;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Task\Task;
use App\Models\Access\User\User;
use App\Models\Service\Service;
use App\Models\ServiceCategory\ServiceCategory;
use App\Models\Client\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon as Carbon;

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
    protected $task;

    
    public function __construct(Task $task)
    {
        $this->task = $task;
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
        $dataTableQuery = $this->query()
            ->leftJoin('users', 'users.id', '=', 'tasks.assignee_id')
            ->leftJoin('services', 'services.id', '=', 'tasks.service_id')
            ->leftJoin('service_categories', 'service_categories.id', '=', 'services.service_cat_id')
            ->leftJoin('clients', 'clients.id', '=', 'services.client_id')
            ->leftJoin('task_types', 'task_types.id', '=', 'tasks.type_id')
            ->select([
                config('task.tasks_table').'.id',
                config('task.tasks_table').'.type_id',
                config('task.tasks_table').'.assignee_id',
                config('task.tasks_table').'.service_id',
                config('task.tasks_table').'.title',
                config('task.tasks_table').'.status',
                config('task.tasks_table').'.isFinished',
                config('task.tasks_table').'.start',
                config('task.tasks_table').'.end',
                config('task.tasks_table').'.created_at',
                config('task.tasks_table').'.updated_at',
            ]);

        return $dataTableQuery;
    }

    /**
     * Create Task.
     *
     * @param Model $request
     */
    public function create($request)
    {
        $data = $request;
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        $task = $this->createTaskStub($data);
        DB::transaction(function () use ($task, $request) {
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

                if($request['nextTask']){
                    $this->createNextTask($task);
                }

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.tasks.create_error'));
        });
    }

    public function createNextTask($input)
    {
        $data = (array)[
            'service_id' => $input->service_id,
            'type_id' => 2,
            'assignee_id' => $input->assignee_id,
            'team' => null,
            'note' => null,
            'start' => Carbon::parse($input->start)->addMonths(6),
            'end' => Carbon::parse($input->start)->addMonths(6)->addHours(3)
        ];

        $nextTask = $this->createTaskStub($data);

        DB::transaction(function () use ($nextTask) {
            if ($nextTask->save()) {
                \Event::dispatch(new TaskCreated($nextTask));
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
        DB::transaction(function () use ($task, $request) {
            if ($task->update($request)) {
                if(Carbon::parse($task->start)->lessThan(Carbon::now())){
                    $task->status = 3;
                } else if(Carbon::parse($task->start)->greaterThan(Carbon::now()) && Carbon::parse($task->start)->lessThan(Carbon::now()->addDays(30))){
                    $task->status = 2;
                } else if(Carbon::parse($task->start) < Carbon::now()->addDays(30)){
                    $task->status = 1;
                } else {
                    $task->status = 0;
                }

                $laterTaskToUpdate = Task::where('assignee_id', '=', $task->assignee_id)
                                ->where('id', '!=', $task->id)
                                ->where('start', '>', $request['start'])
                                ->where('start', '<', $request['end'])
                                ->first();
                $allLaterTasks = Task::where('assignee_id', '=', $task->assignee_id)
                                        ->where('id', '!=', $task->id)
                                        ->where('start', '>', $request['start'])
                                        ->get();
                if($laterTaskToUpdate != null){
                    $delta = date_diff(date_create($laterTaskToUpdate->start), date_create($request['end']));
                    
                    foreach ($allLaterTasks as $laterTask) {

                        $start = date_create($laterTask->start)->add($delta);
                        
                        $end = date_create($laterTask->end)->add($delta);
                        
                        $laterTask->start = $start;
                        $laterTask->end = $end;
                        $laterTask->save();
                    }
                    
                    
                }

                $task->save();

                event(new TaskUpdated($task));

                if($request['nextTask']){
                    $this->createNextTask($task);
                }

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
                event(new TaskPlanned($task));
            break;

            case 1:
                event(new TaskPending($task));
            break;

            case 2:
                event(new TaskOvertime($task));
            break;

        }

        if ($task->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.tasks.mark_error'));
    }

    /**
     * @param $client
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function markFinish($task, $isFinished)
    {
        $task->isFinished = $isFinished;

        switch ($isFinished) {
            case 0:
                if(Carbon::parse($task->start)->lessThan(Carbon::now())){
                    $task->status = 3;
                } else if(Carbon::parse($task->start)->greaterThan(Carbon::now()) && Carbon::parse($task->start)->lessThan(Carbon::now()->addDays(30))){
                    $task->status = 2;
                } else if(Carbon::parse($task->start) < Carbon::now()->addDays(30)){
                    $task->status = 1;
                } else {
                    $task->status = 0;
                }
                event(new TaskRestarted($task));
            break;
            case 1:
                $task->status = 4;
                event(new TaskFinished($task));
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
        $task->service_id = $input['service_id'];
        $service = Service::where('id', $input['service_id'])->first();
        $service_type = ServiceCategory::where('id', $service->service_cat_id)->first();
        $client = Client::where('id', $service->client_id)->first();
        $task->title = $service_type->name.' - '.$client->first_name.' '.$client->last_name;
        $task->type_id = $input['type_id'];
        $task->assignee_id = $input['assignee_id'];

        $task->team = $input['team'];
        $task->note = $input['note'];

        $task->start = Carbon::parse($input['start']);
        $enddate = Carbon::parse($input['start']);
        $enddate->addHours(4);
        $task->end = isset($input['end']) ? Carbon::parse($input['end']) : $enddate;

        if(Carbon::parse($task->start)->lessThan(Carbon::now())){
            $task->status = 3;
        } else if(Carbon::parse($task->start)->greaterThan(Carbon::now()) && Carbon::parse($task->start)->lessThan(Carbon::now()->addDays(30))){
            $task->status = 2;
        } else if(Carbon::parse($task->start) < Carbon::now()->addDays(30)){
            $task->status = 1;
        } else {
            $task->status = 0;
        }
        $task->isFinished = 0;
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
