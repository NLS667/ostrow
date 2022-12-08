<?php

namespace App\Http\Responses\Backend\Task;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Models\Service\Service
     */
    protected $services;

    protected $assignees;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $services
     */
    public function __construct($services, $users, $taskTypes)
    {
        $this->services = $services;

        $this->assignees = $users;

        $this->taskType = $taskTypes;
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
            'assignees' => $this->assignees,
            'taskType' => $this->taskType,
        ]);
    }
}
