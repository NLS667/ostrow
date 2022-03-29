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
        return $this->belongsToMany(Service::class, config('access.service_client_table'), 'client_id', 'service_id');
    }

    /**
     * Many-to-Many relations with Task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, config('access.task_client_table'), 'client_id', 'task_id');
    }
}
