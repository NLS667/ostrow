<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Route;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {

        \Log::info(Route::currentRouteName());
        if(Route::currentRouteName() == 'unisharp.lfm.show'){
            $refererURL = request()->headers->get('referer');
            \Log::info(json_encode($refererURL));
            $lastSegment = basename(parse_url($refererURL, PHP_URL_PATH));
            \Log::info(json_encode($lastSegment));
            if(is_numeric($lastSegment)){
                $client = Client::where('id', $lastSegment)->first();
                return $client->name;
            }
        }
    }
}
