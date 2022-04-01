<?php

namespace App\Models\Model;

use App\Models\Model\Traits\Attribute\ModelAttribute;
use App\Models\Model\Traits\Relationship\ModelRelationship;
use App\Models\BaseModel;

/**
 * Class Model.
 */
class Model extends BaseModel
{
    use ModelAttribute,
        ModelRelationship;
        
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
        $this->table = config('models.models_table');
    }
}
