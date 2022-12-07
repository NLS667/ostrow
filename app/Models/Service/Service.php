<?php

namespace App\Models\Service;

use App\Models\Service\Traits\Attribute\ServiceAttribute;
use App\Models\Service\Traits\Relationship\ServiceRelationship;
use App\Models\BaseModel;
use App\Enums\ServiceTypeEnum;

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
        'client_id',
        'type',
        'models',
        'service_cat_id',
        'offered_at',
        'signed_at',
        'installed_at',
        'created_by',
        'updated_by',
        'deal_amount',
        'advance_date',
        'deal_advance',
    ];

    protected $dates = [
        'offered_at',
        'signed_at',
        'installed_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'type' => ServiceTypeEnum::class
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
