<?php

namespace App\Models\TaskType;

use App\Models\TaskType\Traits\Attribute\TaskTypeAttribute;
use App\Models\TaskType\Traits\Relationship\TaskTypeRelationship;
use App\Models\BaseModel;

/**
 * Class TaskType.
 */
class TaskType extends BaseModel
{
    use TaskTypeAttribute,
        TaskTypeRelationship;
        
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $guarded = ['id'];

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
        $this->table = config('task.tasks_types_table');
    }
}
