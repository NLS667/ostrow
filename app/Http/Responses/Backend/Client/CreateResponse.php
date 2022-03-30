<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Service\Service
     */
    protected $services;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $services
     */
    public function __construct($services)
    {
        $this->services = $services;
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
        return view('backend.client.create')->with([
            'services' => $this->services,
        ]);
    }
}
