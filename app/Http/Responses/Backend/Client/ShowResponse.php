<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Client\Client
     */
    protected $client;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($client, $serviceCategories)
    {
        $this->client = $client;
        $this->serviceCategories = $serviceCategories;
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
        $map_data = [];
        $map_data['mapMode'] = 'small';
        $map_data['mapHeight'] = 600;
        $map_data['mapZoom'] = 12;
        $map_data['markers'][] = (object)[
            'coords' => [$this->client->adr_lattitude, $this->client->adr_longitude],
        ];
        return view('backend.client.show')
                ->with('client', $this->client)
                ->with('serviceCategories', $this->serviceCategories)
                ->with('map_data', $map_data);
    }
}
