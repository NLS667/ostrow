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
    protected $client;

    /**
     * @param ServiceCategoryRepository $serviceCategories
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
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
            ->leftJoin('services', 'services.client_id', '=', 'clients.id')
            ->leftJoin('service_categories', 'services.service_cat_id', '=', 'service_categories.id')
            ->leftJoin('tasks', 'tasks.service_id', '=', 'services.id')
            ->select([
                config('clients.clients_table').'.id',
                config('clients.clients_table').'.first_name',
                config('clients.clients_table').'.last_name',
                config('clients.clients_table').'.adr_street',
                config('clients.clients_table').'.adr_street_nr',
                config('clients.clients_table').'.adr_home_nr',
                config('clients.clients_table').'.adr_zipcode',
                config('clients.clients_table').'.adr_city',
                config('clients.clients_table').'.comm_adr_street',
                config('clients.clients_table').'.comm_adr_street_nr',
                config('clients.clients_table').'.comm_adr_home_nr',
                config('clients.clients_table').'.comm_adr_zipcode',
                config('clients.clients_table').'.comm_adr_city',
                config('clients.clients_table').'.contacts',
                config('clients.clients_table').'.emails',
                config('clients.clients_table').'.phones',
                config('clients.clients_table').'.status',
                config('task.tasks_table').'.status as service_status',
                config('clients.clients_table').'.created_at',
                config('clients.clients_table').'.updated_at',
                config('clients.clients_table').'.deleted_at',
                DB::raw('GROUP_CONCAT(service_categories.short_name SEPARATOR " | ") as services'),
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
        $client = $this->createClientStub($data);
        DB::transaction(function () use ($client, $data) {
            if ($client->save()) {

                //Create folder for client related files
                $dir = storage_path('app/files/'.$client->full_name.'/');
                
                // Make sure the storage path exists and writeable
                if (!is_writable($dir)) {
                    mkdir($dir, 0755, true);
                }

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
        $data = $request->except('services');
        $data['contacts'] = json_encode($request->get('contacts'));
        $data['emails'] = json_encode($request->get('emails'));
        $data['phones'] = json_encode($request->get('phones'));

        DB::transaction(function () use ($client, $data) {
            if ($client->update($data)) {
                
                $client->save();

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
        \Log::info('creating stub');
        $client = self::MODEL;
        $client = new $client();
        $client->first_name = $input['first_name'];
        $client->last_name = $input['last_name'];
        $client->contacts = json_encode($input['contacts']);
        $client->emails = json_encode($input['emails']);
        $client->phones = json_encode($input['phones']);
        $client->adr_country = $input['adr_country'];
        $client->adr_region = $input['adr_region'];
        $client->adr_zipcode = $input['adr_zipcode'];
        $client->adr_city = $input['adr_city'];
        $client->adr_street = $input['adr_street'];
        $client->adr_street_nr = $input['adr_street_nr'];
        $client->adr_home_nr = $input['adr_home_nr'];
        $client->adr_lattitude = $input['adr_lattitude'];
        $client->adr_longitude = $input['adr_longitude'];
        $client->comm_adr_country = $input['comm_adr_country'];
        $client->comm_adr_region = $input['comm_adr_region'];
        $client->comm_adr_zipcode = $input['comm_adr_zipcode'];
        $client->comm_adr_city = $input['comm_adr_city'];
        $client->comm_adr_street = $input['comm_adr_street'];
        $client->comm_adr_street_nr = $input['comm_adr_street_nr'];
        $client->comm_adr_home_nr = $input['comm_adr_home_nr'];
        $client->extra_info = $input['extra_info'];
        $client->status = 1;
        $client->created_by = access()->user()->id;

        return $client;
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
