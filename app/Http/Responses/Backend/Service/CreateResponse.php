<?php

namespace App\Http\Responses\Backend\Service;

use Illuminate\Contracts\Support\Responsable;
use App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository;
use App\Repositories\Backend\Client\ClientRepository;
use App\Repositories\Backend\Model\ModelRepository;


class CreateResponse implements Responsable
{
    /**
     * @var \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository
     */
    protected $serviceCategories;

    /**
     * @var \App\Repositories\Backend\Client\ClientRepository
     */
    protected $clients;

    /**
     * @var \App\Repositories\Backend\Model\ModelRepository
     */
    protected $models;

    /**
     * @param \App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository $serviceCategories
     * @param \App\Repositories\Backend\Client\ClientRepository $clients
     * @param \App\Repositories\Backend\Model\ModelRepository $models
     */
    public function __construct($serviceCategories, $clients, $models)
    {
        $this->serviceCategories = $serviceCategories;
        $this->clients = $clients;
        $this->models = $models;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.service.create')->with([
            'serviceCategories' => $this->serviceCategories,
            'clients' => $this->clients,
            'models' => $this->models,
        ]);
    }
}
