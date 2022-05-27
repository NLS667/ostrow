<?php

namespace App\Http\Responses\Backend\Service;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Service\Service
     */
    protected $service;

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
     * @param \App\Models\Service\Service $service
     */
    public function __construct($service, $serviceCategories, $clients, $models)
    {
        $this->service = $service;
        $this->serviceCategories = $serviceCategories;
        $this->clients = $clients;
        $this->models = $models;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.service.edit')->with([
            'service'            => $this->service,
            'serviceCategories'            => $this->serviceCategories,
            'clients'            => $this->clients,
            'models'            => $this->models,
        ]);
    }
}
