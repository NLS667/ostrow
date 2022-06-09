<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Route;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $refererURL = request()->headers->get('referer');
        $lastSegment = basename(parse_url($refererURL, PHP_URL_PATH));
        if(is_numeric($lastSegment)){
            $client = Client::where('id', $lastSegment)->first();
            return $client->name;
        }
    }
}
