<?php

namespace App\Http\Controllers\Backend\Map;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Service\Service;
use App\Models\ServiceCategory\ServiceCategory;
use Carbon\Carbon as Carbon;

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
        $regions = array(            
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
        );
        $map_data = [];
		$map_data['mapMode'] = 'large';
        $map_data['mapHeight'] = 900;
        $map_data['mapZoom'] = 7;
        $map_data['layers'] = [];

        $serviceCategories = ServiceCategory::all();

        $colors=array("#ff0000", "#00ff00", "#0000ff", "#ff007f", "#ff8000", "#00ffff", "#ffff00", "#ff00ff", "#006600", "#cc99ff");

        if($serviceCategories->count() > 0)
        {
            $x = 0;
            foreach($serviceCategories as $category)
            {
                $map_data['layers'][] = (object)[
                    'id' => $category->id,
                    'name' => $category->name,
                    'color' => $colors[$x],
                    'markers' => [],
                ];

                $x++;
            }
        }

        if($clients->count() > 0)
        {
            foreach($clients as $client)
            {
                $services = Service::where('client_id', $client->id)->get();
                $client_markers = [];
                $client->adr_region = "woj. ".$regions[$client->adr_region];

                foreach($map_data['layers'] as $layer){

                    foreach($services as $service){
                        $catid = $service->service_cat_id;
                        $service_tasks = $service->tasks()->where('isPlanned', '=', false)->whereDate('start', '>', Carbon::now()->subMonths(6))->get();

                        
                        if($layer->id == $catid){ 
                            if(auth()->user()->isAdmin())
                            {               
                                $layer->markers[]  = (object)[
                                    'content' => view('backend.map.popup')->with('client', $client)->render(),
                                    'coords' => [$client->adr_lattitude, $client->adr_longitude],
                                    'title' => $client->full_name,
                                ];
                            } else {
                                foreach($service_tasks as $task){                             
                                    if ($task->assignee_id == auth()->user()->id) {
                                        $layer->markers[]  = (object)[
                                            'content' => view('backend.map.popup')->with('client', $client)->render(),
                                            'coords' => [$client->adr_lattitude, $client->adr_longitude],
                                            'title' => $client->full_name,
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }  
        }

        return view('backend.map.index')->with('map_data', $map_data);
    }
}