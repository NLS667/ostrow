<?php

namespace App\Events\Service;

use Illuminate\Queue\SerializesModels;

/**
 * Class ServiceDeleted.
 */
class ServiceDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $service;

    /**
     * @param $user
     */
    public function __construct($service)
    {
        $this->service = $service;
    }
}
