<?php

namespace App\Models\Device;

use App\Models\Device\Traits\Attribute\ModelAttribute;
use App\Models\Device\Traits\Relationship\ModelRelationship;
use App\Models\BaseModel;

/**
 * Class Device.
 */
class Device extends BaseModel
{
    use DeviceAttribute,
        DeviceRelationship;
        
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
        'serial_number',
        'model_id',
        'service_id',
        'created_by',
        'updated_by',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('devices.devices_table');
    }
}
