<?php

namespace App\Http\Responses\Backend\Task;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $task;
    

    /**
     * @param \App\Models\Task\Task $task
     */
    public function __construct($task, $services, $users)
    {
        $this->task = $task;
        $this->services = $services;
        $this->assignees = $users;
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
        return view('backend.task.edit')->with([
            'task'                => $this->task,
            'services'            => $this->services,
            'assignees'           => $this->assignees,
        ]);
    }
}
