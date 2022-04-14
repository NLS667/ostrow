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
        return $this->hasMany(Model::class, 'producer_id', 'id');
    }

}
