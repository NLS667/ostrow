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
        $attributePermission = ['40', '41', '42', '43'];
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
                if ($i != 3) {
                    $actionButton = $actionButton.''.$this->getActionButtonsByPermissionName($value, $i);
                }

                if ($i == 3) {
                    $actionButton = $actionButton.''.$this->getActionButtonsByPermissionName($value, $i);

                    if ($permissionCounter > 3) {
                        $actionButton = $actionButton.'
                        <div class="btn-group dropup">
                        <a class="btn btn-default btn-round dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">';
                    }
                }
                $i++;
            }
            $actionButton .= '</ul></div>';

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
        // check if counter is less then 3 then apply button client
        $class = ($counter <= 3) ? 'btn btn-primary btn-round' : '';

        switch ($permissionName) {
            case 'edit-producer':
            $button = ($counter <= 3) ? $this->getEditButtonAttribute('btn btn-success btn-round') : '<li>'
            .$this->getEditButtonAttribute($class).
            '</li>';
            break;
            case 'delete-producer':
            $button = ($counter <= 3) ? $this->getDeleteButtonAttribute('btn btn-danger btn-round') : '<li>'
            .$this->getDeleteButtonAttribute($class).
            '</li>';
            break;
            default:
            $button = '';
            break;
        }

        return $button;
    }
    
}
