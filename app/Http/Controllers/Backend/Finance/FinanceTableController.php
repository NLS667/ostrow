<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Finance\ManageFinanceRequest;
use App\Repositories\Backend\Service\ServiceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class FinanceTableController.
 */
class FinanceTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Service\ServiceRepository
     */
    protected $services;

    /**
     * @param \App\Repositories\Backend\Service\ServiceRepository $clients
     */
    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Finance\ManageFinanceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageFinanceRequest $request)
    {
        return Datatables::make($this->getForDataTable())
            ->escapeColumns(['id'])
            ->editColumn('first_name', function ($service) {
                return $service->full_name;
            })
            ->editColumn('adr_street', function ($service) {
                return $service->address;
            })
            ->addColumn('actions', function ($service) {
                return $service->action_buttons;
            })
            ->make(true);
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
        $dataTableQuery = $this->services->query()
            ->leftJoin('clients', 'services.client_id', '=', 'clients.id')
            ->leftJoin('service_categories', 'services.client_id', '=', 'service_categories.id')
            ->select([
                'services.id',
                'clients.first_name',
                DB::raw('GROUP_CONCAT(service_categories.short_name SEPARATOR " | ") as services'),
                'services.offered_at',
                'services.signed_at',
                'services.installed_at',
            ])
            ->groupBy('services.id');
        \Log::info(json_encode($dataTableQuery->get()));
        // active() is a scope on the ClientScope trait
        return $dataTableQuery->get();
    }
}
