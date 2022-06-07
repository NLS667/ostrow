<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Finance\ManageFinanceRequest;
use App\Repositories\Backend\Service\ServiceRepository;
use Carbon\Carbon;
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
        return Datatables::make($this->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['id'])
            ->addColumn('actions', function ($service) {
                return $client->action_buttons;
            })
            ->make(true);
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
        $dataTableQuery = $this->services->query()
            ->leftJoin('clients', 'services.client_id', '=', 'clients.id')
            ->leftJoin('tasks', 'tasks.service_id', '=', 'services.id')
            ->select([
                'services.id',
                'clients.full_name',
                'services.service_type AS services',
                'services.offered_at',
                'services.signed_at',
                'services.installed_at',
            ]);

        if ($trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        \Log::info(json_encode($dataTableQuery))
        // active() is a scope on the ClientScope trait
        return $dataTableQuery->active($status);
    }
}
