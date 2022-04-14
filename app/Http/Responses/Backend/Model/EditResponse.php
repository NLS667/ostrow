<?php

namespace App\Http\Responses\Backend\Model;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Model\Model
     */
    protected $model;



    /**
     * @param \App\Models\Model\Model $model
     */
    public function __construct($model, $producers)
    {
        $this->model = $model;
        $this->producers = $producers;
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
        return view('backend.model.edit')->with([
            'model'            => $this->model,
            'modelProducer'    => $this->model->model->pluck('id')->all(),
            'producers'        => $this->producers,
        ]);
    }
}
