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
        'email',
        'phone_nr',
        'adr_country',
        'adr_region',
        'adr_zipcode',
        'adr_city',
        'ad_street',
        'adr_street_nr',        
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
