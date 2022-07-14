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
      return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function service() {
      return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function client() {
      $this->service->client;
    }
}
