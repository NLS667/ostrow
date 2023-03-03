<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Responses\ViewResponse;
use App\Http\Requests\Backend\Finance\ManageFinanceRequest;
use App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Repositories\Backend\Client\ClientRepository;

/**
 * Class FinanceController.
 */
class FinanceController extends Controller
{
	/**
     * @var \App\Repositories\Backend\Client\ClientRepository
     */
    protected $clients;

    /**
     * @var \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository
     */
    protected $serviceCategories;

    /**
     * @var \App\Repositories\Backend\Service\ServiceRepository
     */
    protected $services;

    /**
     * @param \App\Repositories\Backend\Client\ClientRepository                   $clients
     * @param \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository $serviceCategories
     * @param \App\Repositories\Backend\Service\ServiceRepository                 $services
     */
    public function __construct(ClientRepository $clients, ServiceCategoryRepository $serviceCategories, ServiceRepository $services)
    {
        $this->clients = $clients;
        $this->serviceCategories = $serviceCategories;
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Finance\ManageFinanceRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageFinanceRequest $request)
    {
    	$clients = $this->clients->getAll();
        $GrandTotalAmount = 0;
        $GrandTotalAdvance = 0;
        $GrandTotalLeft = 0;
    	$finance_data = [];
    	foreach($clients as $client){    		
    		$client_services = $this->services->query()->where('client_id', $client->id)->get();
    		if($client_services->count() > 0){
                foreach($client_services as $client_service){
                    $GrandTotalAmount += $client_service->deal_amount;
                    if($client_service->deal_advance != null){
                        $GrandTotalAdvance += array_sum(json_decode($client_service->deal_advance));
                    }
                    $GrandTotalLeft += $client_service->deal_amount - array_sum(json_decode($client_service->deal_advance));
                }
    			$finance_data[] = (object)[
	    			'name' => $client->full_name,
	                'address' => $client->address,
	                'services' => $client_services,
	    		];
    		}
    	}

        $gt_data['GTAmount'] = number_format($GrandTotalAmount, 2, '.', "");
        $gt_data['GTAdvance'] = number_format($GrandTotalAdvance, 2, '.', "");
        $gt_data['GTLeft'] = number_format($GrandTotalLeft, 2, '.', "");

        return new ViewResponse('backend.finance.index', ['data' => $finance_data, 'GrandTotal' => $gt_data]);
    }
}