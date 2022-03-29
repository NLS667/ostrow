<?php

namespace App\Models\Service;

use App\Models\Service\Traits\Attribute\ServiceAttribute;
use App\Models\Service\Traits\Relationship\ServiceRelationship;
use App\Models\BaseModel;

/**
 * Class Service.
 */
class Service extends BaseModel
{
    use ServiceAttribute,
        ServiceRelationship;
        
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('service.services_table');
    }
}
