<?php

namespace App\Models\ServiceCategory\Traits\Relationship;

/**
 * Class ServiceCategoryRelationship.
 */
trait ServiceCategoryRelationship
{
    /**
     * @return mixed
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, config('service.service_client_table'), 'service_id', 'client_id');
    }

    /**
     * @return mixed
     */
    public function tasks()
    {
        return $this->belongsToMany(config('tasks.task'), config('task.task_service_table'), 'service_id', 'task_id')
            ->orderBy('name', 'asc');
    }
}
