<?php

namespace App\Models\Service\Traits\Scope;

/**
 * Class ServiceScope.
 */
trait ServiceScope
{
    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where(config('service.services_table').'.status', $status);
    }
}
