<?php

namespace App\Models\Client\Traits\Scope;

/**
 * Class ClientScope.
 */
trait ClientScope
{
    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = 1)
    {
        return $query->where(config('clients.clients_table').'.status', $status);
    }
}
