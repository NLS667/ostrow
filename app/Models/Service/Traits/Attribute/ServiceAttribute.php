<?php

namespace App\Models\Service\Traits\Attribute;

use App\Models\Client\Client;
use App\Models\ServiceCategory\ServiceCategory;

/**
 * Class ServiceAttribute.
 */
trait ServiceAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-service')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.service.edit', $this).'">
            <span class="material-icons">edit</span>
            </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if (access()->allow('delete-service')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.service.destroy', $this).'"
            data-method="delete"
            data-trans-button-cancel="Anuluj"
            data-trans-button-confirm="Usuń"
            data-trans-title="Czy na pewno?"><span class="material-icons">delete</span>'.$name.'</a>';
        }

        return '';
    }

    /**
     * @return string
     */
    
    public function getActionButtonsAttribute()
    {
        // Check if role have all permission
        if (access()->user()->roles[0]->all) {
            return '<div class="btn-group action-btn">
            '.$this->getEditButtonAttribute('btn btn-success btn-flat').'
            '.$this->getDeleteButtonAttribute('btn btn-danger btn-flat').'
            </div>';
        } else {
            $userPermission = $this->getUserPermission();
            $permissionCounter = count($userPermission);
            $actionButton = '<div class="btn-group action-btn">';
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
                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">';
                    }
                }
                $i++;
            }
            $actionButton .= '</ul></div></div>';

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
        $class = ($counter <= 3) ? 'btn btn-primary btn-flat' : '';

        switch ($permissionName) {
            case 'edit-service':
            $button = ($counter <= 3) ? $this->getEditButtonAttribute($class) : '<li>'
            .$this->getEditButtonAttribute($class).
            '</li>';
            break;
            case 'delete-service':
            if (access()->user()->id != $this->id) {
                $button = ($counter <= 3) ? $this->getDeleteButtonAttribute($class) : '<li>'
                .$this->getDeleteButtonAttribute($class).
                '</li>';
            } else {
                $button = '';
            }
            break;
            default:
            $button = '';
            break;
        }

        return $button;
    }

    public function getServiceNameAttribute()
    {
        $client = Client::where('id', $this->client_id)->first();
        $service_type = ServiceCategory::where('id', $this->service_cat_id)->first();
        $service_name = $service_type->name.' - '.$client->first_name.' '.$client->last_name;
        return $service_name;
    }

    public function getServiceTypeAttribute()
    {
        $service_type = ServiceCategory::where('id', $this->service_cat_id)->first();
        return $service_type->name;
    }

    public function getServiceTypeShortAttribute()
    {
        $service_type = ServiceCategory::where('id', $this->service_cat_id)->first();
        return $service_type->short_name;
    }
    
}
