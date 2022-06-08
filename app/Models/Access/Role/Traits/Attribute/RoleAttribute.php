<?php

namespace App\Models\Access\Role\Traits\Attribute;

/**
 * Class RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }
    
    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-role')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.access.role.edit', $this).'">
                    <span class="material-icons">edit</span>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        //Can't delete master admin role
        if ($this->id != 1 && access()->allow('delete-role')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.access.role.destroy', $this).'" data-method="delete"
                        data-trans-button-cancel="Anuluj"
                        data-trans-button-confirm="Usuń"
                        data-trans-title="Czy na pewno?">
                            <span class="material-icons">delete</span>
                    </a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute('btn btn-success btn-round').'
                '.$this->getDeleteButtonAttribute('btn btn-danger btn-round');
    }
}
