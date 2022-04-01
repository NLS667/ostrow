<?php

namespace App\Events\Producer;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProducerDeleted.
 */
class ProducerDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $producer;

    /**
     * @param $user
     */
    public function __construct($producer)
    {
        $this->producer = $producer;
    }
}
