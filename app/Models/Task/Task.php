<?php

namespace App\Models\Task;

use App\Models\Task\Traits\Attribute\TaskAttribute;
use App\Models\Task\Traits\Relationship\TaskRelationship;
use App\Models\BaseModel;

/**
 * Class Task.
 */
class Task extends BaseModel
{
    use TaskAttribute,
        TaskRelationship;
        
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
        'assignee_id',
        'service_id',
        'type_id',
        'status',
        'isFinished',
        'team',
        'note',
        'start',
        'end',
        'created_by',
        'updated_by',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('task.tasks_table');
    }
}
