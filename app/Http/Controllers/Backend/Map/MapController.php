<?php

namespace App\Http\Controllers\Backend\Map;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Client;

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

        if($clients->count() > 0)
        {
            foreach($clients as $client)
            {
                $map_data['markers'][] = (object)[
                    'content' => view('backend.map.popup')->with('client', $client)->render(),
                    'coords' => [$client->adr_lattitude, $client->adr_longitude],
                ];
            }  
        } 
        return view('backend.map.index')->with('map_data', $map_data);
    }
}