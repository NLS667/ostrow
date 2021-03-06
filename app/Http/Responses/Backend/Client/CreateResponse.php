<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $serviceCategories;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $serviceCategories
     */
    public function __construct($serviceCategories)
    {
        $this->serviceCategories = $serviceCategories;
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
        return view('backend.client.create');
    }
}
