<?php

namespace App\Http\Responses\Backend\TaskType;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\TaskType\TaskType
     */
    protected $taskType;


    /**
     * @param \App\Models\TaskType\TaskType $taskType
     */
    public function __construct($taskType)
    {
        $this->taskType = $taskType;
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
        return view('backend.taskType.edit')->with([
            'taskType'            => $this->taskType,
        ]);
    }
}
