<?php

namespace App\Http\Controllers\Backend\Device;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Device\ManageDeviceRequest;
use App\Repositories\Backend\Device\DeviceRepository;
use App\Repositories\Backend\Service\ServiceRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class DeviceTableController.
 */
class DeviceTableController extends Controller
{
    protected $devices;

    /**
     * @param \App\Repositories\Backend\Model\ModelRepository $service
     */
    public function __construct(DeviceRepository $devices, ServiceRepository $services)
    {
        $this->devices = $devices;
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Device\ManageDeviceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageDeviceRequest $request)
    {
        return Datatables::make($this->devices->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('serial_number', function ($device) {
                return $device->serial_number;
            })
            ->addColumn('model', function ($device) {
                return $device->model;
            })
            ->addColumn('service', function ($device) {
                $service = $this->services->find($device->service);
                return $service->service_name;
            })
            ->addColumn('created_at', function ($device) {
                return Carbon::parse($device->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($device) {
                if(isset($device->updated_at))
                {
                    return Carbon::parse($device->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->make(true);
    }
}
