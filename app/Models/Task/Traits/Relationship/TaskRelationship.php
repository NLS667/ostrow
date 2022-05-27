<?php

namespace App\Models\Task\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\Service\Service;

/**
 * Class TaskRelationship.
 */
trait TaskRelationship
{
    public function assignee() {
      return $this->belongsTo(User::class);
    }

    public function service() {
      return $this->belongsTo(Service::class);
    }
}
