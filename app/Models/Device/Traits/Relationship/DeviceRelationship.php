<?php

namespace App\Models\Device\Traits\Relationship;

use App\Models\Service\Service;
use App\Models\Model\Model;

/**
 * Class DeviceRelationship.
 */
trait DeviceRelationship
{
    /**
     * @return mixed
     */
    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    /**
     * @return mixed
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
