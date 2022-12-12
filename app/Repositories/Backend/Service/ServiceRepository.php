<?php

namespace App\Repositories\Backend\Service;

use App\Events\Service\ServiceCreated;
use App\Events\Service\ServiceDeleted;
use App\Events\Service\ServiceUpdated;
use App\Exceptions\GeneralException;
use App\Models\Service\Service;
use App\Models\Client\Client;
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

    /**
     * @param ServiceRepository $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('service_categories', 'service_categories.id', '=', 'services.service_cat_id')
            ->leftJoin('clients', 'clients.id', '=', 'services.client_id')
            ->select([
                'services.id',
                'clients.first_name AS client',
                'clients.last_name',
                'service_categories.name AS category',
                'services.models',
                'services.offered_at',
                'services.signed_at',
                'services.installed_at',
                'services.deal_amount',
                'services.deal_advance',
            ]);
    }

    /**
     * Create Service.
     *
     * @param Model $request
     */
    public function create($request)
    {
        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $service = self::MODEL;
            $service = new $service();
            $service->client_id = $request['client_id'];
            $service->service_cat_id = $request['service_cat_id'];

            $serviceCat = ServiceCategory::where('id', $this['service_cat_id'])->first();
            $type = $serviceCat->type;

            if($type == 'Zwykła')
            {
                $service->models = json_encode($request['models']);
                $service->offered_at = $request['offered_at'];
                $service->signed_at = $request['signed_at'];
                $service->installed_at = $request['installed_at'];
                $service->deal_amount = $request['deal_amount'];
                $service->advance_date = json_encode($request['advance_date']);
                $service->deal_advance = json_encode($request['deal_advance']);
            } else {
                $service->models = null;
                $service->offered_at = null;
                $service->signed_at = null;
                $service->installed_at = null;
                $service->deal_amount = null;
                $service->advance_date = null;
                $service->deal_advance = null;
            }
            

            $service->created_by = access()->user()->id;

            if ($service->save()) {

                $client = Client::where('id', $service->client_id)->first();
                
                //Create folder for client related files                
                $dir = storage_path('app/files/'.$client->full_name.'/'.$service->service_type.'/');
                
                // Make sure the storage path exists and writeable
                if (!is_writable($dir)) {
                    mkdir($dir, 0755, true);
                }

                event(new ServiceCreated($service));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.services.create_error'));
        });
    }

    /**
     * Update Service
     * 
     * @param Model $service
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($service, $request)
    {
        DB::transaction(function () use ($service, $request) {
            if ($service->update($request)) {
                
                $service->save();

                event(new ServiceUpdated($service));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.services.update_error'));
        });
    }

    /**
     * Delete Service.
     *
     * @param Model $service
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($service)
    {
        if ($service->delete()) {
            event(new ServiceDeleted($service));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.services.delete_error'));
    }

}
