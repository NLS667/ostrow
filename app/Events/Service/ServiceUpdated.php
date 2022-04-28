<?php

namespace App\Events\Service;

use Illuminate\Queue\SerializesModels;

/**
 * Class ServiceUpdated.
 */
class ServiceUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $service;

    /**
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }
}
