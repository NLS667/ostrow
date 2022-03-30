<?php

namespace App\Repositories\Backend\Client;

use App\Events\Client\ClientCreated;
use App\Events\Client\ClientDeactivated;
use App\Events\Client\ClientDeleted;
use App\Events\Client\ClientPermanentlyDeleted;
use App\Events\Client\ClientReactivated;
use App\Events\Client\ClientRestored;
use App\Events\Client\ClientUpdated;
use App\Exceptions\GeneralException;
use App\Models\Client\Client;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ClientRepository.
 */
class ClientRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Client::class;

    /**
     * @var Client Model
     */
    protected $model;

    /**
     * @var ServiceRepository
     */
    protected $service;

    /**
     * @param ServiceRepository $service
     */
    public function __construct(Client $model, ServiceRepository $service)
    {
        $this->model = $model;
        $this->service = $service;
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
                config('clients.clients_table').'.id',
                config('clients.clients_table').'.first_name',
                config('clients.clients_table').'.last_name',
                config('clients.clients_table').'.email',
                config('clients.clients_table').'.status',
                config('clients.clients_table').'.created_at',
                config('clients.clients_table').'.updated_at',
                config('clients.clients_table').'.deleted_at',
                DB::raw('GROUP_CONCAT(services.name) as services'),
            ])
            ->groupBy('clients.id');

        if ($trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        // active() is a scope on the ClientScope trait
        return $dataTableQuery->active($status);
    }

    /**
     * Create Client.
     *
     * @param Model $request
     */
    public function create($request)
    {
        $data = $request->except('services');
        $services = $request->get('services');
        $client = $this->createClientStub($data);
        DB::transaction(function () use ($client, $data, $services) {
            if ($user->save()) {

                //Client Created, Validate Roles
                //if (!count($roles)) {
                //    throw new GeneralException(trans('exceptions.backend.access.users.role_needed_create'));
                //}

                //Attach new roles
                $client->attachServices($services);

                // Attach New Permissions
                //$client->attachTasks($tasks);

                //Send confirmation email if requested and account approval is off
                //if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                 //   $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                //}

                event(new ClientCreated($client));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.clients.create_error'));
        });
    }

    /**
     * @param Model $client
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($client, $request)
    {
        $data = $request->except('services', 'tasks');
        $services = $request->get('services');
        $tasks = $request->get('tasks');

        DB::transaction(function () use ($client, $data, $services, $tasks) {
            if ($user->update($data)) {
                $user->status = isset($data['status']) && $data['status'] == '1' ? 1 : 0;
                
                $user->save();

                event(new ClientUpdated($client));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.clients.update_error'));
        });
    }

    /**
     * Delete Client.
     *
     * @param Model $client
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($client)
    {
        if ($client->delete()) {
            event(new ClientDeleted($client));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.clients.delete_error'));
    }

    /**
     * @param $client
     *
     * @throws GeneralException
     */
    public function forceDelete($client)
    {
        if (is_null($client->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.clients.delete_first'));
        }

        DB::transaction(function () use ($client) {
            if ($client->forceDelete()) {
                event(new ClientPermanentlyDeleted($client));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.clients.delete_error'));
        });
    }

    /**
     * @param $client
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function restore($client)
    {
        if (is_null($client->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.clients.cant_restore'));
        }

        if ($client->restore()) {
            event(new ClientRestored($client));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.clients.restore_error'));
    }

    /**
     * @param $client
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark($client, $status)
    {
        $client->status = $status;

        switch ($status) {
            case 0:
                event(new ClientDeactivated($client));
            break;

            case 1:
                event(new ClientReactivated($client));
            break;
        }

        if ($client->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.clients.mark_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createClientStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->status = isset($input['status']) ? 1 : 0;
        $user->created_by = access()->user()->id;

        return $user;
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
