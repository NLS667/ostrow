<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;
use App\Models\Client\Client;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $currentURL = URL::current();
        $lastSegment = basename(parse_url($currentURL, PHP_URL_PATH));
        $client = Client::where('id', $lastSegment)->first();
        return $client->name;
    }
}
