<?php

namespace App\Http\Responses\Backend\Task;

use Illuminate\Contracts\Support\Responsable;

class RaportResponse implements Responsable
{
    protected $task;
    

    /**
     * @param \App\Models\Task\Task $task
     */
    public function __construct($task)
    {
        $this->task = $task;
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
        return view('backend.task.raports.form')->with([
            'task'                => $this->task,
        ]);
    }
}
