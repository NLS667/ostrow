<?php

namespace App\Handlers;

use Illuminate\Support\Facades\URL;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $currentURL = URL::current();
        \Debugbar::info($currentURL);
        return parent::userField();
    }
}
