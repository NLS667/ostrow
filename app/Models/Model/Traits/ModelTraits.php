<?php

namespace App\Models\Model\Traits;

/**
 * Class ModelTraits.
 */
trait ModelTraits
{
    /**
     * Alias to eloquent many-to-many relation's attach() method.
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

        $this->producers()->attach($producer);
    }
}