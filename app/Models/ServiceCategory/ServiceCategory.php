<?php

namespace App\Models\ServiceCategory;

use App\Models\ServiceCategory\Traits\Attribute\ServiceCategoryAttribute;
use App\Models\ServiceCategory\Traits\Relationship\ServiceCategoryRelationship;
use App\Models\BaseModel;
use App\Enums\ServiceCategoryTypeEnum;

/**
 * Class ServiceCategory.
 */
class ServiceCategory extends BaseModel
{
    use ServiceCategoryAttribute,
        ServiceCategoryRelationship;
        
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
        'type',
        'short_name',
        'description',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'type' => ServiceCategoryTypeEnum::class
    ];
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('service.servicecategory_table');
    }
}
