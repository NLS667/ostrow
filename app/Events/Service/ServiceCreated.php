<?php

namespace App\Events\Service;

use Illuminate\Queue\SerializesModels;

/**
 * Class ServiceCreated.
 */
class ServiceCreated
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
