<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Client\ManageClientRequest;
use App\Repositories\Backend\Client\ClientRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ClientTableController.
 */
class ClientTableController extends Controller
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
     * @param \App\Http\Requests\Backend\Client\ManageClientRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageClientRequest $request)
    {
        return Datatables::make($this->clients->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['id'])
            ->editColumn('phones', function ($client) {
                if(isset($client->phones)){
                    return $client->phones;
                } else {
                    return 'Brak';
                }
            })
            ->editColumn('emails', function ($client) {
                if(isset($client->emails)){
                    return $client->emails;
                } else {
                    return 'Brak';
                }
            })
            ->editColumn('adr_street', function ($client) {
                return $client->address;
            })
            ->editColumn('comm_adr_street', function ($client) {
                return $client->comm_address;
            })
            ->addColumn('service_status', function ($client) {
                return $client->service_status;
            })
            ->addColumn('status', function ($client) {
                return $client->status;
            })
            ->addColumn('created_at', function ($client) {
                return Carbon::parse($client->created_at)->format('Y');
            })
            ->addColumn('updated_at', function ($client) {
                if(isset($client->updated_at)){
                    return Carbon::parse($client->updated_at)->toDateString();
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($client) {
                return $client->action_buttons;
            })
            ->make(true);
    }
}
