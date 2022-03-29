<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Client\Client
     */
    protected $client;

    /**
     * @var \App\Models\Access\Task\Task
     */
    protected $tasks;

    /**
     * @var \App\Models\Access\Service\Service
     */
    protected $services;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($client, $services, $tasks)
    {
        $this->client = $client;
        $this->services = $services;
        $this->tasks = $tasks;
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
        $tasks = $this->tasks;
        $clientTasks = $this->client->tasks()->get()->pluck('id')->toArray();

        return view('backend.access.clients.edit')->with([
            'client'            => $this->client,
            'clientServices'    => $this->client->services->pluck('id')->all(),
            'services'          => $this->services,
            'clientTasks'       => $clientTasks,
            'permissions'       => $tasks,
        ]);
    }
}
