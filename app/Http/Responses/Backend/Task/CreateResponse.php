<?php

namespace App\Http\Responses\Backend\Task;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Service\Service
     */
    protected $services;

    protected $clients;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $services
     */
    public function __construct($services, $clients)
    {
        $this->services = $services;

        $this->clients = $clients;
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
        return view('backend.task.create')->with([
            'services' => $this->services,
            'clients' => $this->clients,
        ]);
    }
}
