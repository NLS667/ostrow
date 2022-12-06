<?php

namespace App\Http\Responses\Backend\Note;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Note\Note
     */
    protected $note;


    /**
     * @param \App\Models\Note\Note $note
     */
    public function __construct($note)
    {
        $this->note = $note;
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
        return $this->note->toJson();
    }
}
