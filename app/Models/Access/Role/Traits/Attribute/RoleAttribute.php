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
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-role')) {
            return '<a class="btn btn-flat btn-success" href="'.route('admin.access.role.edit', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="Edytuj" class="fas fa-pencil-alt"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //Can't delete master admin role
        if ($this->id != 1 && access()->allow('delete-role')) {
            return '<a class="btn btn-flat btn-danger" href="'.route('admin.access.role.destroy', $this).'" data-method="delete"
                        data-trans-button-cancel="Anuluj"
                        data-trans-button-confirm="Usuń"
                        data-trans-title="Czy na pewno?">
                            <i data-toggle="tooltip" data-placement="top" title="Usuń" class="fas fa-trash"></i>
                    </a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-role', 'admin.access.role.edit').'
                    '.$this->getDeleteButtonAttribute().'
                </div>';
    }
}
