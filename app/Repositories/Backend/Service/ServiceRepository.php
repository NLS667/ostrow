<?php

namespace App\Repositories\Backend\Service;

use App\Events\Service\ServiceCreated;
use App\Events\Service\ServiceDeleted;
use App\Events\Service\ServiceUpdated;
use App\Exceptions\GeneralException;
use App\Models\Service\Service;
use App\Models\Client\Client;
use App\Models\Device\Device;
use App\Models\ServiceCategory\ServiceCategory;
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
        $service = $this->createServiceStub($request);
        DB::transaction(function () use ($service) {

            if ($service->save()) {

                $models = json_decode($service->models);
                $devices = json_decode($service->devices);

                if($devices != null and count(json_decode($service->devices)) > 0){

                    for($i=0;$i<count($devices);$i++)
                    {                        
                        $model_id = $models[$i];
                        $serials = explode (",", $devices[$i]);

                        foreach($serials as $serial)
                        {
                            $device = Device::class;
                            $device = new $device();
                            $device->serial_number = $serial;
                            $device->model_id = $model_id;
                            $device->service_id = $service->id;
                            $device->created_by = $service->created_by;
                            DB::transaction(function () use ($device) {
                                if ($device->save()) {
                                    return true;
                                }
                            });
                        }                        
                    }
                }

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
        $old_models = json_decode($service->models);
        $new_models = $request['models'];
        $models_to_delete = array_diff($old_models, $new_models);
        $models_to_create = array_diff($new_models, $old_models);

        $old_devices = json_decode($service->devices);
        $new_devices = $request['devices'];

        if(count($old_models) > 0){
            for($i=0;$i < count($old_models); $i++)
            {
                $old_dev = explode (",", $old_devices[$i]);
                $new_dev = explode (",", $request['devices'][$i]);

                $devices_to_delete = array_diff($old_dev, $new_dev);
                if(count($devices_to_delete) > 0) {
                    foreach($devices_to_delete as $serial_number)
                    {
                        $devdel = Device::where('serial_number', $serial_number)->first();
                        $devdel->delete();
                    }
                }

                $devices_to_create = array_diff($new_dev, $old_dev);
                if(count($devices_to_create) > 0) {
                    foreach($devices_to_create as $serial_number)
                    {
                        $devcrea = Device::class;
                        $devcrea = new $devcrea();
                        $devcrea->serial_number = $serial_number;
                        $devcrea->model_id = $old_models[$i];
                        $devcrea->service_id = $service->id;
                        $devcrea->created_by = $service->created_by;
                        DB::transaction(function () use ($devcrea) {
                            if ($devcrea->save()) {
                                return true;
                            }
                        }); 
                    }
                }

            }
        }

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
        $old_devices = json_decode($service->devices);
        if(count($old_devices) > 0){
            for($i=0;$i < count($old_devices); $i++)
            {
                $todelete = explode (",", $old_devices[$i]);
                foreach($todelete as $dev_to_del)
                {
                    $devdel = Device::where('serial_number', $dev_to_del)->first();
                    $devdel->delete();
                }
            }
        }

        if ($service->delete()) {
            event(new ServiceDeleted($service));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.services.delete_error'));
    }

    /**
     * @param  $request
     *
     * @return mixed
     */
    protected function createServiceStub($request)
    {
        $service = self::MODEL;
        $service = new $service();
        $service->client_id = $request['client_id'];
        $service->service_cat_id = $request['service_cat_id'];

        $serviceCat = ServiceCategory::where('id', $request['service_cat_id'])->first();
        switch ($serviceCat->type) {
            case 'Zwykła':
                $service->models = json_encode($request['models']);
                $service->devices = json_encode($request['devices']);
                $service->offered_at = $request['offered_at'];
                $service->signed_at = $request['signed_at'];
                $service->installed_at = $request['installed_at'];
                $service->deal_amount = $request['deal_amount'];
                if (array_key_exists("advance_date", $request)){
                    $service->advance_date = json_encode($request['advance_date']);
                    $service->deal_advance = json_encode($request['deal_advance']);
                } else {
                    $service->advance_date = json_encode([]);
                    $service->deal_advance = json_encode([]);
                }
                break;
            case 'Dodatkowa':
                $service->models = null;
                $service->devices = null;
                $service->offered_at = null;
                $service->signed_at = null;
                $service->installed_at = null;
                $service->deal_amount = null;
                $service->advance_date = null;
                $service->deal_advance = null;
                break;
        }
        
        $service->created_by = access()->user()->id;
        return $service;
    }

}
