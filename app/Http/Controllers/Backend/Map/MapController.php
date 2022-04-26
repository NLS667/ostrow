<?php

namespace App\Http\Controllers\Map;

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
        $clients = Client::all();
        $map_data = [];

        if($clients->count() > 0)
        {
            $map_data['mapMode'] = 'large';
            $map_data['mapHeight'] = 900;
            $map_data['mapZoom'] = 7;
            $map_data['markers'] = [];

            foreach($clients as $client)
            {
                $map_data['markers'][] = (object)[
                    'name' => $client->name,
                    'coords' => [$client->adr_lattitude, $client->adr_longitude],
                ];
            }   
        }
        return view('backend.map.index')->with('map_data', $map_data);
    }
}