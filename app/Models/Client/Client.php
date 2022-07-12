<?php

namespace App\Models\Client;

use App\Models\Client\Traits\Attribute\ClientAttribute;
use App\Models\Client\Traits\Relationship\ClientRelationship;
use App\Models\Client\Traits\Scope\ClientScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

/**
 * Class Client.
 */
class Client extends BaseModel
{
    use ClientAttribute,
        ClientRelationship,
        ClientScope,
        SoftDeletes;
        
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
        'first_name',
        'last_name',
        'emails',
        'phones',
        'adr_country',
        'adr_region',
        'adr_zipcode',
        'adr_city',
        'ad_street',
        'adr_street_nr', 
        'adr_lattitude',       
        'adr_longitude',
        'comm_adr_country',
        'comm_adr_region',
        'comm_adr_zipcode',
        'comm_adr_city',
        'comm_ad_street',
        'comm_adr_street_nr',
        'extra_info',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('client.clients_table');
    }
}
