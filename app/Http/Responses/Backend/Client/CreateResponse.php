<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $serviceCategories;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $serviceCategories
     */
    public function __construct($serviceCategories)
    {
        $this->serviceCategories = $serviceCategories;
        $this->regions = (object)[
            "02" => "dolnośląskie",
            "04" => "kujawsko-pomorskie",
            "06" => "lubelskie",
            "08" => "lubuskie",
            "10" => "łódzkie",
            "12" => "małopolskie",
            "14" => "mazowieckie",
            "16" => "opolskie",
            "18" => "podkarpackie",
            "20" => "podlaskie",
            "22" => "pomorskie",
            "24" => "śląskie",
            "26" => "świętokrzyskie",
            "28" => "warmińsko-mazurskie",
            "30" => "wielkopolskie",
            "32" => "zachodniopomorskie"
        ];
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
        return view('backend.client.create')->with([
            'regions'               => $this->regions,
        ]);
    }
}
