<?php

namespace App\Models\Client\Traits\Relationship;

use App\Models\Task\Task;
use App\Models\Service\Service;

/**
 * Class ClientRelationship.
 */
trait ClientRelationship
{
    /**
     * Many-to-Many relations with Service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'client_id')->where('type', '==', 'Zwykła');
    }

    /**
     * Many-to-Many relations with Task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
