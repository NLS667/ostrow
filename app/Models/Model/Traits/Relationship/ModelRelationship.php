<?php

namespace App\Models\Model\Traits\Relationship;

use App\Models\Producer\Producer;
use App\Models\Device\Device;

/**
 * Class ModelRelationship.
 */
trait ModelRelationship
{
    /**
     * @return mixed
     */
    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    /**
     * @return mixed
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

}
