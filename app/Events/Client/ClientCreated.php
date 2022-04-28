<?php

namespace App\Events\Client;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientCreated.
 */
class ClientCreated
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
