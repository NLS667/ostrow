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
    protected $service;

    /**
     * @param \App\Repositories\Backend\Service\ServiceRepository $service
     */
    public function __construct(ServiceRepository $service)
    {
        $this->service = $service;
    }

    /**
     * @param \App\Http\Requests\Backend\Service\ManageServiceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageServiceRequest $request)
    {
        return Datatables::of($this->service->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('description', function ($service) {
                return $service->description;
            })
            ->addColumn('created_by', function ($service) {
                return $service->created_by;
            })
            ->addColumn('created_at', function ($service) {
                return Carbon::parse($service->created_at)->toDateString();
            })
            ->addColumn('actions', function ($service) {
                return $service->action_buttons;
            })
            ->make(true);
    }
}
