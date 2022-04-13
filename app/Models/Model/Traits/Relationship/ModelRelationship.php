<?php

namespace App\Models\Model\Traits\Relationship;

use App\Models\Producer\Producer;

/**
 * Class ModelRelationship.
 */
trait ModelRelationship
{
    /**
     * @return mixed
     */
    public function producers()
    {
        return $this->belongsTo(Producer::class, config('producers.producer_model_table'), 'producer_id', 'model_id');
    }

}
