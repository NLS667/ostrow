<?php

namespace App\Repositories\Backend\Device;

//use App\Events\Model\ModelCreated;
//use App\Events\Model\ModelDeleted;
//use App\Events\Model\ModelUpdated;
use App\Exceptions\GeneralException;
use App\Models\Device\Device;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Repositories\Backend\Model\ModelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class DeviceRepository.
 */
class DeviceRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Device::class;
    /**
     * @var DeviceRepository
     */
    protected $device;

    /**
     * @var ModelRepository
     */
    protected $model;

    /**
     * @var ServiceRepository
     */
    protected $service;


    /**
     * @param ModelRepository $model
     */
    public function __construct(Device $device, ModelRepository $model, ServiceRepository $producer)
    {
        $this->device = $device;
        $this->model = $model;
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('service', 'devices.service_id', '=', 'services.id')
            ->leftJoin('models', 'devices.model_id', '=', 'models.id')
            ->select([
                config('devices.devices_table').'.id',
                config('devices.devices_table').'.serial_number',
                config('services.services_table').'.id as service',
                config('models.models_table').'.id as model',
                config('devices.devices_table').'.created_at',
                config('devices.devices_table').'.updated_at',
            ]);
    }

    /**
     * Create Device.
     *
     * @param Device $request
     */
    public function create($request)
    {
        if ($this->query()->where('serial_number', $request['serial_number'])->first()) {
            throw new GeneralException(trans('exceptions.backend.device.already_exists'));
        }

        $device = $this->createDeviceStub($request);
        DB::transaction(function () use ($device) {

            if ($device->save()) {

                //event(new ModelCreated($device));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.devices.create_error'));
        });
    }

    /**
     * Update Device
     * 
     * @param Device $device
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($device, $request)
    {
        DB::transaction(function () use ($device, $request) {
            $device->service_id = $request['service'];
            if ($device->update($request)) {
                
                $device->save();

                //event(new ModelUpdated($device));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.devices.update_error'));
        });
    }

    /**
     * Delete Device.
     *
     * @param Device $device
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($device)
    {
        if ($device->delete()) {
            //event(new ModelDeleted($device));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.devices.delete_error'));
    }

    /**
     * @param  $request
     *
     * @return mixed
     */
    protected function createDeviceStub($request)
    {
        $device = self::MODEL;
        $device = new $device();
        $device->serial_number = $request['serial_number'];
        $device->service_id = $request['service'];
        $device->model_id = $request['model'];
        $device->created_by = access()->user()->id;

        return $device;
    }

}
