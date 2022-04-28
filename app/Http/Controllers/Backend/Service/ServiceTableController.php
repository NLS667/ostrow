<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Service\ManageServiceRequest;
use App\Repositories\Backend\Service\ServiceRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ServiceTableController.
 */
class ServiceTableController extends Controller
{
    protected $services;

    /**
     * @param \App\Repositories\Backend\Service\ServiceRepository $services
     */
    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Service\ManageServiceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageServiceRequest $request)
    {
        return Datatables::make($this->services->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('description', function ($service) {
                return $service->description;
            })
            ->addColumn('modelCount', function ($service) {
                return $service->models()->count();
            })
            ->addColumn('created_at', function ($service) {
                return Carbon::parse($service->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($service) {
                if(isset($service->updated_at))
                {
                    return Carbon::parse($service->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($service) {
                return $service->action_buttons;
            })
            ->make(true);
    }
}
