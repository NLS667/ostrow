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
    public function model()
    {
        return $this->belongsTo(Producer::class,  'id');
    }

}
