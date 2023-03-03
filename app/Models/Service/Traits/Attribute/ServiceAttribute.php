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
     * Get logged in user permission related to user management grid.
     *
     * @return array
     */
    public function getUserPermission()
    {
        $userPermission = [];
        $attributePermission = ['34', '35'];
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
        switch ($permissionName) {
            case 'edit-service':
            $button = $this->getEditButtonAttribute('btn btn-success btn-round');
            break;
            case 'delete-service':
            $button = $this->getDeleteButtonAttribute('btn btn-danger btn-round');
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
        \Log::info($client);
        $service_type = ServiceCategory::where('id', $this->service_cat_id)->first();
        \Log::info($service_type);
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
    

    /**
     * @return string
     */
    public function getFinanceActionButtonAttribute()
    {
        if (access()->allow('edit-service')) {
            return '<a class="btn btn-success btn-round" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.service.edit', $this).'">
                        <span class="material-icons">edit</span>
                    </a>';
        }
    }
}
