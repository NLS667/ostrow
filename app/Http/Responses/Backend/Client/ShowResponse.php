<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Service\Service;
use App\Models\Model\Model;
use App\Models\Producer\Producer;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Client\Client
     */
    protected $client;

    /**
     * @param \App\Models\Access\Client\Client $client
     */
    public function __construct($client, $serviceCategories, $services, $helper)
    {
        $this->client = $client;
        $this->serviceCategories = $serviceCategories;
        $this->services = $services;
        $this->helper = $helper;
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
        $map_data['mapHeight'] = 500;
        $map_data['mapZoom'] = 12;
        $map_data['markers'][] = (object)[
            'coords' => [$this->client->adr_lattitude, $this->client->adr_longitude],
        ];
        $client_data = [];
        foreach($this->serviceCategories as $category)
        {
            $service = Service::where('client_id', $this->client->id)->where('service_cat_id', $category->id)->first();
            $model = Model::where('id', $service->model_id)->first();
            $producer = Producer::where('id', $model->id)->first();
            $client_data[] = (object)[
                'category' => $category->name.' ('.$category->short_name.')',
                'service' => (object)['id' => $service->id, 'offered_at' => $service->offered_at, 'signed_at' => $service->signed_at, 'installed_at' => $service->installed_at],
                'model' => $model->name,
                'serial_number' => $model->serial_number,
                'producer' => $producer->name,
            ];
        }
        return view('backend.client.show')
                ->with('client', $this->client)
                ->with('client_data', $client_data)
                ->with('map_data', $map_data)
                ->with('helper', $this->helper);
    }
}
