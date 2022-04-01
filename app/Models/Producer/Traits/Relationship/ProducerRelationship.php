<?php

namespace App\Models\Producer\Traits\Relationship;

/**
 * Class ProducerRelationship.
 */
trait ProducerRelationship
{
    /**
     * @return mixed
     */
    public function models()
    {
        return $this->hasMany(Model::class, config('producer.producer_model_table'), 'producer_id', 'model_id');
    }

}
