<?php

namespace App\Models\Service\Traits\Relationship;

use App\Models\ServiceCategory\ServiceCategory;
use App\Models\Device\Device;
use App\Models\Client\Client;
use App\Models\Task\Task;

/**
 * Class ServiceRelationship.
 */
trait ServiceRelationship
{
    /**
     * @return mixed
     */
    public function type()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_cat_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

}
