<?php

namespace App\Events\Producer;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProducerUpdated.
 */
class ProducerUpdated
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
