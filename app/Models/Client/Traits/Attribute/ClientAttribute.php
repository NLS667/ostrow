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
            return '<a class="'.$class.'" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Zobacz" href="'.route('admin.client.show', $this).'">
                        <i class="material-icons">visibility</i>
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
        switch ($permissionName) {
            case 'show-client':
                $button = $this->getShowButtonAttribute('btn btn-info btn-round');
                break;
            case 'edit-client':
                $button = $this->getEditButtonAttribute('btn btn-success btn-round');
                break;
            case 'activate-client':
                if (\Route::currentRouteName() == 'admin.client.deactivated.get') {
                    $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'deactivate-client':
                if (\Route::currentRouteName() == 'admin.client.get') {
                    $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'delete-client':
                $button = $this->getDeleteButtonAttribute('btn btn-danger btn-round');
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

    public function getMainEmailAttribute(){
        $emails = json_decode($this->emails);
        return $emails[0];
    }

    public function getMainPhoneAttribute(){
        $phones = json_decode($this->phones);
        return $phones[0];
    }

    public function getCommAddressAttribute(){
        $street = $this->comm_adr_street.' '.$this->comm_adr_street_nr;
        if(isset($this->comm_adr_home_nr)){
            $street .= ' m.'.$this->comm_adr_home_nr;
        }
        $address = $street.'<br>'.$this->comm_adr_zipcode.' '.$this->comm_adr_city;
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
                    if($task->status != 4){
                        $highest_status = $task->status;
                    }
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
        $attributePermission = ['24', '26', '27', '28', '29', '30', '31'];
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
        if ($this->trashed()) {
            return $this->getRestoreButtonAttribute('btn btn-success btn-round').'
                   '.$this->getDeletePermanentlyButtonAttribute('btn btn-danger btn-round');
        }

        // Check if role have all permission
        if (access()->user()->roles[0]->all) {
            return $this->getShowButtonAttribute('btn btn-info btn-round').'
                    '.$this->getEditButtonAttribute('btn btn-success btn-round').'
                    '.$this->getDeleteButtonAttribute('btn btn-danger btn-round').'                        
                    '.$this->getStatusButtonAttribute('btn btn-warning btn-round');
        } else {
            $userPermission = $this->getUserPermission();
            $permissionCounter = count($userPermission);
            $actionButton = '';
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
                    $actionButton = $actionButton.' '.$this->getActionButtonsByPermissionName($value, $i);
                }
                /**
                if ($i == 3) {
                    $actionButton = $actionButton.' '.$this->getActionButtonsByPermissionName($value, $i);

                    if ($permissionCounter > 3) {
                        $actionButton = $actionButton.'
                            <div class="btn-group dropup">
                            <button type="button" class="btn btn-default btn-round dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-option-vertical"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">';
                    }
                }*/
                $i++;
            }
            //$actionButton .= '</ul></div>';

            return $actionButton;
        }
    }

}
