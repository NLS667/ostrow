<?php

namespace App\Events\Service;

use App\Models\Service\Service;
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
     * @param $user
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
