<?php

namespace App\Models\Task\Traits\Attribute;

/**
 * Class TaskAttribute.
 */
trait TaskAttribute
{    
    /**
     * @return string
     */
    public function getShowButtonAttribute($class)
    {
        if (access()->allow('show-task')) {
            return '<a class="'.$class.'"  data-toggle="tooltip" data-placement="top" title="Zobacz" href="'.route('admin.task.show', $this).'">
                        <span class="material-icons">visibility</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-task')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.task.edit', $this).'">
                        <span class="material-icons">edit</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if ($this->id != access()->id() && access()->allow('delete-task')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.task.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="Anuluj"
                 data-trans-button-confirm="Usuń"
                 data-trans-title="Czy na pewno?"><span class="material-icons">delete</span>'.$name.'</a>';
        }

        return '';
    }

    public function getNameAttribute()
    {
        return $this->name;
    }
}
