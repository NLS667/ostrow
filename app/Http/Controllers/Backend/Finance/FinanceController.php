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

    	$finance_data = [];
    	foreach($clients as $client){    		
    		$client_services = $this->services->query()->where('client_id', $client->id)->get();
    		if($client_services->count() > 0){
    			$finance_data[] = (object)[
	    			'name' => $client->full_name,
	                'address' => $client->address,
	                'services' => $client_services,
	    		]
    		}
    	}

        return new ViewResponse('backend.finance.index', ['data' => $finance_data]);
    }
}