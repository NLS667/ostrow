<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $client;
    /**
     * @var \App\Models\Access\ServiceCategory\ServiceCategory
     */
    protected $serviceCategories;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($client, $serviceCategories)
    {
        $this->client = $client;
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
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.client.edit')->with([
            'client'                => $this->client,
            'serviceCategories'     => $this->serviceCategories,
            'regions'               => $this->regions,
        ]);
    }
}
