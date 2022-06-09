<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        if(Route::currentRouteName() == 'laravel-filemanager'){
            $refererURL = request()->headers->get('referer');
            \Log::info(json_encode($refererURL));
            $lastSegment = basename(parse_url($refererURL, PHP_URL_PATH));
            if(is_numeric($lastSegment)){
                $client = Client::where('id', $lastSegment)->first();
                return $client->name;
            }
        }
    }
}
