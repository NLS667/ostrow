<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Finance\ManageFinanceRequest;
use App\Repositories\Backend\Client\ClientRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class FinanceTableController.
 */
class FinanceTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Client\ClientRepository
     */
    protected $clients;

    /**
     * @param \App\Repositories\Backend\Client\ClientRepository $clients
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
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
            ->editColumn('first_name', function ($client) {
                return $client->name;
            })
            ->editColumn('adr_street', function ($client) {
                return $client->address;
            })
            ->addColumn('actions', function ($client) {
                return '';
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
        $dataTableQuery = $this->clients->query()
            ->leftJoin('services', 'services.client_id', '=', 'clients.id')
            ->leftJoin('service_categories', 'services.client_id', '=', 'service_categories.id')
            ->select([
                config('clients.clients_table').'.id',
                config('clients.clients_table').'.first_name',
                config('clients.clients_table').'.last_name',
                config('clients.clients_table').'.adr_street',
                config('clients.clients_table').'.adr_street_nr',
                config('clients.clients_table').'.adr_home_nr',
                config('clients.clients_table').'.adr_zipcode',
                config('clients.clients_table').'.adr_city',
                DB::raw('GROUP_CONCAT(service_categories.short_name SEPARATOR " | ") as services'),
                'services.offered_at',
                'services.signed_at',
                'services.installed_at',
            ])
            ->groupBy('clients.id');
        \Log::info(json_encode($dataTableQuery->get()));
        // active() is a scope on the ClientScope trait
        return $dataTableQuery->get();
    }
}
