<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Access\ServiceCategory\ServiceCategory
     */
    protected $serviceCategories;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($serviceCategories)
    {
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
            'serviceCategories'          => $this->serviceCategories,
        ]);
    }
}
