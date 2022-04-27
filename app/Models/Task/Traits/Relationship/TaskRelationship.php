<?php

namespace App\Models\Task\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\Client\Client;

/**
 * Class TaskRelationship.
 */
trait TaskRelationship
{
    public function user() {
      return $this->belongsTo(User::class);
    }

    public function client() {
      return $this->belongsTo(Client::class);
    }
}
