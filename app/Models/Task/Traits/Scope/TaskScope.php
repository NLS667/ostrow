<?php

namespace App\Models\Task\Traits\Scope;

/**
 * Class TaskScope.
 */
trait TaskScope
{
    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopePlanned($query, $isPlanned = 0)
    {
        return $query->where('tasks.isPlanned', $isPlanned);
    }
}
