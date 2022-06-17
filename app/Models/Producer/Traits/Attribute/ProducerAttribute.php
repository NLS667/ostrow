<?php

namespace App\Models\Producer\Traits\Attribute;

/**
 * Class ProducerAttribute.
 */
trait ProducerAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-producer')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.producer.edit', $this).'">
            <span class="material-icons">edit</span>
            </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if (access()->allow('delete-producer')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.producer.destroy', $this).'"
            data-method="delete"
            data-trans-button-cancel="Anuluj"
            data-trans-button-confirm="Usuń"
            data-trans-title="Czy na pewno?"><span class="material-icons">delete</span>'.$name.'</a>';
        }

        return '';
    }

    /**
     * Get logged in user permission related to user management grid.
     *
     * @return array
     */
    public function getUserPermission()
    {
        $userPermission = [];
        $attributePermission = ['42', '43'];
        foreach (access()->user()->permissions as $permission) {
            if (in_array($permission->id, $attributePermission)) {
                $userPermission[] = $permission->name;
            }
        }

        return $userPermission;
    }

    /**
     * @return string
     */
    
    public function getActionButtonsAttribute()
    {
        // Check if role have all permission
        if (access()->user()->roles[0]->all) {
            return $this->getEditButtonAttribute('btn btn-success btn-round').'
            '.$this->getDeleteButtonAttribute('btn btn-danger btn-round');
        } else {
            $userPermission = $this->getUserPermission();
            $permissionCounter = count($userPermission);
            $actionButton = '';
            $i = 1;

            foreach ($userPermission as $value) {
                $actionButton = $actionButton.' '.$this->getActionButtonsByPermissionName($value, $i);
                $i++;
            }

            return $actionButton;
        }
    }

    /**
     * Get action button attribute by permission name.
     *
     * @param string $permissionName
     * @param int    $counter
     *
     * @return string
     */
    public function getActionButtonsByPermissionName($permissionName, $counter)
    {
        switch ($permissionName) {
            case 'edit-producer':
            $button = $this->getEditButtonAttribute('btn btn-success btn-round');
            break;
            case 'delete-producer':
            $button = $this->getDeleteButtonAttribute('btn btn-danger btn-round');
            break;
            default:
            $button = '';
            break;
        }

        return $button;
    }
    
}
