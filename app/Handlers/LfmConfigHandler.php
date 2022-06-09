<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;
use App\Models\Client\Client;
use App\Http\Requests\Request;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $currentURL = Request::server('HTTP_REFERER').
        $lastSegment = basename(parse_url($currentURL, PHP_URL_PATH));
        $client = Client::where('id', $lastSegment)->first();
        return $client->name;
    }
}
