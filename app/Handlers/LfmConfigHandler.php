<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $currentURL = request()->headers->get('referer');
        $lastSegment = basename(parse_url($currentURL, PHP_URL_PATH));
        $client = Client::where('id', $lastSegment)->first();
        \Log::info(json_encode($client));
        return $client->name;
    }
}
