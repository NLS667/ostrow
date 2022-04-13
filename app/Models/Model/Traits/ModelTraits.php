<?php

namespace App\Models\Model\Traits;

/**
 * Class ModelTraits.
 */
trait ModelTraits
{
    /**
     * Alias to eloquent belongs-to relation's associate() method.
     *
     * @param mixed $producer
     *
     * @return void
     */
    public function attachProducer($producer)
    {
        if (is_object($producer)) {
            $producer = $producer->getKey();
        }

        if (is_array($producer)) {
            $producer = $producer['id'];
        }
        \Log::info($producer);
        $this->producers()->associate($producer);
    }
}