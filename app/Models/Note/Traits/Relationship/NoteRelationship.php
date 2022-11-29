<?php

namespace App\Models\Note\Traits\Relationship;

use App\Models\Client\Client;

/**
 * Class NoteRelationship.
 */
trait NoteRelationship
{
    /**
     * @return mixed
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
