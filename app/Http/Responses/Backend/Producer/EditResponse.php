<?php

namespace App\Http\Responses\Backend\Producer;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Producer\Producer
     */
    protected $producer;


    /**
     * @param \App\Models\Producer\Producer $producer
     */
    public function __construct($producer)
    {
        $this->producer = $producer;
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
        return view('backend.producer.edit')->with([
            'producer'            => $this->producer,
        ]);
    }
}
