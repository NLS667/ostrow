<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        if($request->is('*/laravel-filemanager'){
            $currentURL = request()->headers->get('referer');
            \Log::info(json_encode($currentURL));
            $lastSegment = basename(parse_url($currentURL, PHP_URL_PATH));
            if(is_numeric($lastSegment)){
                $client = Client::where('id', $lastSegment)->first();
                return $client->name;
            }
        }
    }
}
