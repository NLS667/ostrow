<?php

namespace App\Models\Producer\Traits\Relationship;

use App\Models\Model\Model;

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
