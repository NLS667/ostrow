<?php

namespace App\Repositories\Backend\Service;

use App\Events\Service\ServiceCreated;
use App\Events\Service\ServiceDeleted;
use App\Events\Service\ServiceUpdated;
use App\Exceptions\GeneralException;
use App\Models\Service\Service;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ServiceRepository.
 */
class ServiceRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Service::class;

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
    public function __construct(Service $model)
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
            ->leftJoin('service_client', 'service_client.client_id', '=', 'clients.id')
            ->select([
                config('service.services_table').'.id',
                config('service.services_table').'.name',
                config('service.services_table').'.description',
                DB::raw('(SELECT COUNT(service_client.id) FROM service_client LEFT JOIN clients ON service_client.client_id = clients.id WHERE service_client.service_id = services.id AND clients.deleted_at IS NULL) AS clientCount'),
                config('service.services_table').'.created_at',
                config('service.services_table').'.updated_at',
                DB::raw('GROUP_CONCAT(services.name) as services'),
            ])
            ->groupBy('clients.id');
    }

    /**
     * Create Service.
     *
     * @param Model $request
     */
    public function create($request)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.service.already_exists'));
        }

        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $service = self::MODEL;
            $service = new $service();
            $service->name = $input['name'];
            $service->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

            $service->created_by = access()->user()->id;

            if ($service->save()) {

                event(new ServiceCreated($service));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.service.create_error'));
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
