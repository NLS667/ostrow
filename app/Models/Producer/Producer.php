<?php

namespace App\Models\Producer;

use App\Models\Producer\Traits\Attribute\ProducerAttribute;
use App\Models\Producer\Traits\Relationship\ProducerRelationship;
use App\Models\BaseModel;

/**
 * Class Producer.
 */
class Producer extends BaseModel
{
    use ProducerAttribute,
        ProducerRelationship;
        
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
        $this->table = config('producer.producers_table');
    }
}
