<?php

namespace App\Models\Service\Traits\Relationship;

use App\Models\ServiceCategory\ServiceCategory;
use App\Models\Client\Client;
use App\Models\Access\User\User;

/**
 * Class ServiceRelationship.
 */
trait ServiceRelationship
{
    /**
     * @return mixed
     */
    public function type()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_cat_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
