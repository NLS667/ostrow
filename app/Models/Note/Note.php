<?php

namespace App\Models\Note;

//use App\Models\Note\Traits\Attribute\NoteAttribute;
use App\Models\Note\Traits\Relationship\NoteRelationship;
use App\Models\BaseModel;

/**
 * Class Note.
 */
class Note extends BaseModel
{
    use NoteAttribute,
        NoteRelationship;
        
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
        'content',
        'client_id',
        'created_by',
        'updated_by',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('notes.notes_table');
    }
}
