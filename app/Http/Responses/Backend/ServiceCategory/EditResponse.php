<?php

namespace App\Http\Responses\Backend\ServiceCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\ServiceCategory\ServiceCategory
     */
    protected $serviceCategory;


    /**
     * @param \App\Models\ServiceCategory\ServiceCategory $serviceCategory
     */
    public function __construct($serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
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
        return view('backend.serviceCategory.edit')->with([
            'serviceCategory'            => $this->serviceCategory,
        ]);
    }
}
