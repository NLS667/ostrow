<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $client;
    /**
     * @var \App\Models\Access\ServiceCategory\ServiceCategory
     */
    protected $serviceCategories;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($client, $serviceCategories)
    {
        $this->client = $client;
        $this->serviceCategories = $serviceCategories;
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
        return view('backend.access.clients.edit')->with([
            'client'                => $this->client,
            'serviceCategories'     => $this->serviceCategories,
        ]);
    }
}
