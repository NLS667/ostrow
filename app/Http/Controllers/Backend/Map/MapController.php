<?php

namespace App\Http\Controllers\Backend\Map;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Service\Service;
use App\Models\ServiceCategory\ServiceCategory;

class MapController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::where('status', 1)->get();
        $map_data = [];
		$map_data['mapMode'] = 'large';
        $map_data['mapHeight'] = 900;
        $map_data['mapZoom'] = 7;
        $map_data['markers'] = [];
        $map_data['layers'] = [];

        $serviceCategories = ServiceCategory::all();

        if($serviceCategories->count() > 0)
        {
            foreach($serviceCategories as $category)
            {
                $map_data['layers'][$category->id] = (object)[
                    'name' => $category->name,
                    'markers' => [],
                ];
            }
        }

        if($clients->count() > 0)
        {
            foreach($clients as $client)
            {
                $services = Service::where('client_id', $client->id);

                foreach($services as $service){
                    $catid = $service->service_cat_id;
                    
                    if($client->id == $service->client_id){
                        $map_data['layers'][$catid]['markers'][] = (object)[
                            'content' => view('backend.map.popup')->with('client', $client)->render(),
                            'coords' => [$client->adr_lattitude, $client->adr_longitude],
                        ];
                    }
                }

                $map_data['markers'][] = (object)[
                    'content' => view('backend.map.popup')->with('client', $client)->render(),
                    'coords' => [$client->adr_lattitude, $client->adr_longitude],
                ];
            }  
        } 
        \Log::info(json_encode($map_data));
        return view('backend.map.index')->with('map_data', $map_data);
    }
}