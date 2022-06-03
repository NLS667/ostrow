<?php

namespace App\Models\Client\Traits\Attribute;

use App\Models\Service\Service;
use App\Models\Task\Task;

/**
 * Class ClientAttribute. 
 */
trait ClientAttribute
{
    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='badge badge-success'>Aktywny</label>";
        }

        return "<label class='badge badge-danger'>Nieaktywny</label>";
    }
    
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute($class)
    {
        if (access()->allow('show-client')) {
            return '<a class="'.$class.'"  data-toggle="tooltip" data-placement="top" title="Zobacz" href="'.route('admin.client.show', $this).'">
                        <span class="material-icons">visibility</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-client')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.client.edit', $this).'">
                        <span class="material-icons">edit</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if (access()->allow('delete-client')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.client.destroy', $this).'"
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
    public function getStatusButtonAttribute($class)
    {
        switch ($this->status) {
            case 0:
            if (access()->allow('activate-client')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Aktywuj' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Aktywuj" href="'.route('admin.client.mark', [$this, 1]).'"><span class="material-icons">lock_open</span>'.$name.'</a>';
            }
            break;

            case 1:
            if (access()->allow('deactivate-client')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Deaktywuj' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Deaktywuj" href="'.route('admin.client.mark', [$this, 0]).'"><span class="material-icons">lock</span>'.$name.'</a>';
            }
            break;

            default:
            return '';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute($class)
    {
        if (access()->allow('delete-client')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Przywróć Klienta" href="'.route('admin.client.restore', $this).'" name="restore_client">
                        <span class="material-icons">sync_alt</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute($class)
    {
        return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń permanetnie" href="'.route('admin.client.delete-permanently', $this).'" name="delete_client_perm">
                    <span class="material-icons">delete</span>
                </a>';
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
            case 'show-client':
                $button = ($counter <= 3) ? $this->getShowButtonAttribute($class) : '<li>'
                    .$this->getShowButtonAttribute($class).
                    '</li>';
                break;
            case 'edit-client':
                $button = ($counter <= 3) ? $this->getEditButtonAttribute($class) : '<li>'
                    .$this->getEditButtonAttribute($class).
                    '</li>';
                $button .= ($counter <= 3) ? $this->getChangePasswordButtonAttribute($class) : '<li>'
                    .$this->getChangePasswordButtonAttribute($class).
                    '</li>';
                break;
            case 'activate-client':
                if (\Route::currentRouteName() == 'admin.client.deactivated.get') {
                    $button = ($counter <= 3) ? $this->getStatusButtonAttribute($class) : '<li>'
                    .$this->getStatusButtonAttribute($class).
                    '</li>';
                } else {
                    $button = '';
                }
                break;
            case 'deactivate-client':
                if (\Route::currentRouteName() == 'admin.client.get') {
                    $button = ($counter <= 3) ? $this->getStatusButtonAttribute($class) : '<li>'
                    .$this->getStatusButtonAttribute($class).
                    '</li>';
                } else {
                    $button = '';
                }
                break;
            case 'delete-client':
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

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getAddressAttribute(){
        $street = $this->adr_street.' '.$this->adr_street_nr;
        if(isset($this->adr_home_nr)){
            $street .= ' m.'.$this->adr_home_nr;
        }
        $address = $street.'<br>'.$this->adr_zipcode.' '.$this->adr_city;
        return $address;
    }

    public function getServiceStatusAttribute()
    {
        $services = Service::where('client_id', $this->id)->get();
        $highest_status = 0;
        foreach($services as $service){
            $tasks = Task::where('service_id', $service->id)->get();
            foreach($tasks as $task){
                if($task->status > $highest_status){
                    $highest_status = $task->status;
                }
            }            
        }
        $service_status = $highest_status;
        return $service_status;
    }

    /**
     * Get logged in user permission related to user management grid.
     *
     * @return array
     */
    public function getUserPermission()
    {
        $userPermission = [];
        $attributePermission = ['24', '26', '27', '28', '29'];
        foreach (access()->user()->permissions as $permission) {
            if (in_array($permission->id, $attributePermission)) {
                $userPermission[] = $permission->name;
            }
        }

        return $userPermission;
    }

    public function checkAdmin()
    {
        if ($this->id != 1) {
            return '<div class="btn-group dropup">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="material-icons">settings</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            '.$this->getStatusButtonAttribute('dropdown-item').'
                            '.$this->getClearSessionButtonAttribute('dropdown-item').'
                            '.$this->getDeleteButtonAttribute('dropdown-item').'
                            '.$this->getLoginAsButtonAttribute('dropdown-item').'
                        </div>
                    </div>';
        }
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $service
     *
     * @return void
     */
    public function attachService($service)
    {
        if (is_object($service)) {
            $service = $service->getKey();
        }

        if (is_array($service)) {
            $service = $service['id'];
        }

        $this->services()->attach($service);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $service
     *
     * @return void
     */
    public function detachService($service)
    {
        if (is_object($service)) {
            $service = $service->getKey();
        }

        if (is_array($service)) {
            $service = $service['id'];
        }

        $this->services()->detach($service);
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '<div class="btn-group action-btn">
                        '.$this->getRestoreButtonAttribute('btn btn-success btn-flat').'
                        '.$this->getDeletePermanentlyButtonAttribute('btn btn-danger btn-flat').'
                    </div>';
        }

        // Check if role have all permission
        if (access()->user()->roles[0]->all) {
            return '<div class="btn-group action-btn">
                    '.$this->getShowButtonAttribute('btn btn-info btn-flat').'
                    '.$this->getEditButtonAttribute('btn btn-success btn-flat').'
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="material-icons">settings</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            '.$this->getDeleteButtonAttribute('dropdown-item').'                        
                            '.$this->getStatusButtonAttribute('dropdown-item').'
                        </div>
                    </div>
                </div>';
        } else {
            $userPermission = $this->getUserPermission();
            $permissionCounter = count($userPermission);
            $actionButton = '<div class="btn-group action-btn">';
            $i = 1;

            if (access()->user()->id == $this->id) {
                
                if (in_array('delete-client', $userPermission)) {
                    $permissionCounter = $permissionCounter - 1;
                }

                if (in_array('deactivate-client', $userPermission)) {
                    $permissionCounter = $permissionCounter - 1;
                }
            }

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
}
