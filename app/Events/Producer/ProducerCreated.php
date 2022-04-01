<?php

namespace App\Events\Producer;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProducerCreated.
 */
class ProducerCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $producer;

    /**
     * @param $producer
     */
    public function __construct($producer)
    {
        $this->producer = $producer;
    }
}
