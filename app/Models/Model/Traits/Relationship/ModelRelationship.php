<?php

namespace App\Models\Model\Traits\Relationship;

/**
 * Class ModelRelationship.
 */
trait ModelRelationship
{
    /**
     * @return mixed
     */
    public function models()
    {
        return $this->belongsTo(Producer::class, config('producer.producer_model_table'), 'producer_id', 'model_id');
    }

}
