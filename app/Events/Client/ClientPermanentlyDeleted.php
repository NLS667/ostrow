<?php

namespace App\Events\Client;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientPermanentlyDeleted.
 */
class ClientPermanentlyDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $client;

    /**
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}
