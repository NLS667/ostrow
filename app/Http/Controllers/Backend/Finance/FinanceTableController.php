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
        return Datatables::make($this->services->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['id'])
            ->addColumn('actions', function ($service) {
                return $client->action_buttons;
            })
            ->make(true);
    }
}
