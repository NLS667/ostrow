<?php

namespace App\Http\Responses\Backend\Model;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Repositories\Backend\Producer\ProducerRepository
     */
    protected $producers;

    /**
     * @param \App\Repositories\Backend\Producer\ProducerRepository $producers
     */
    public function __construct($producers)
    {
        $this->producers = $producers;
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
        return view('backend.model.create')->with([
            'producers' => $this->producers,
        ]);
    }
}
