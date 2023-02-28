<?php

namespace App\Models\Task\Traits\Attribute;

use App\Models\Access\User\User;
use App\Models\Service\Service;
use App\Models\TaskType\TaskType;
use App\Models\ServiceCategory\ServiceCategory;
use App\Models\Client\Client;

/**
 * Class TaskAttribute.
 */
trait TaskAttribute
{  
    /**
     * @return string
     */
    public function getStatusButtonAttribute($class)
    {
        switch ($this->isFinished) {
            case 0:
            if (access()->allow('deactivate-task')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Zakończ' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Zakończ" href="'.route('admin.task.mark', [$this, 1]).'"><span class="material-icons">lock</span>'.$name.'</a>';
            }
            break;
            case 1:
            if (access()->allow('activate-task')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Wznów' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Wznów" href="'.route('admin.task.mark', [$this, 0]).'"><span class="material-icons">lock_open</span>'.$name.'</a>';
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
    public function getPlanButtonAttribute($class)
    {
        switch ($this->isPlanned) {
            case 1:
            if (access()->allow('edit-task')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Aktywuj' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Aktywuj" href="'.route('admin.task.togglePlanned', [$this, 0]).'"><span class="material-icons">event_available</span>'.$name.'</a>';
            }
            break;
            case 0:
            if (access()->allow('edit-task')) {
                $name = ($class == '' || $class == 'dropdown-item') ? 'Zaplanuj' : '';

                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Zaplanuj" href="'.route('admin.task.togglePlanned', [$this, 1]).'"><span class="material-icons">event_repeat</span>'.$name.'</a>';
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
        if (access()->allow('delete-task')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.task.destroy', $this).'"
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
    public function getRaportButtonAttribute($class)
    {
        if (access()->allow('get-task-raport')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Pobierz protokół" href="'.route('admin.task.getRaport', $this).'" target="_blank">
                        <span class="material-icons">description</span>
                    </a>';
        }
    }

    /**
     * Get logged in user permission related to user management grid.
     *
     * @return array
     */
    public function getUserPermission()
    {
        $userPermission = [];
        $attributePermission = ['50', '51', '64', '65', '71', '72'];
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
            '.$this->getPlanButtonAttribute('btn btn-primary btn-round').' 
            '.$this->getDeleteButtonAttribute('btn btn-danger btn-round').'                       
            '.$this->getStatusButtonAttribute('btn btn-warning btn-round').'                        
            '.$this->getRaportButtonAttribute('btn btn-info btn-round');
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
            case 'edit-task':
            $button = $this->getEditButtonAttribute('btn btn-success btn-round').' '.$this->getPlanButtonAttribute('btn btn-primary btn-round');
            break;
            case 'delete-task':
            $button = $this->getDeleteButtonAttribute('btn btn-danger btn-round');
            break;
            case 'activate-task':
            $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
            break;
            case 'deactivate-task':
            $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
            break;
            case 'get-task-raport':
            $button = $this->getRaportButtonAttribute('btn btn-warning btn-round');
            break;
            //case 'create-task-raport':
            //$button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
            //break;
            default:
            $button = '';
            break;
        }

        return $button;
    }

    public function getAssigneeNameAttribute()
    {
        $user = User::where('id', $this->assignee_id)->first();
        
        if($user){
            $assignee_name = $user->first_name.' '.$user->last_name;
            return $assignee_name;           
        } else {
            return "Nie przypisano"; 
        }  
    }

    public function getTypeAttribute()
    {
        $type = TaskType::where('id', $this->type_id)->first();        
        $type_name = $type->name;
        return $type_name;  
    }

    public function getServiceNameAttribute()
    {
        $service = Service::where('id', $this->service_id)->first();
        $client = Client::where('id', $service->client_id)->first();
        $service_type = ServiceCategory::where('id', $service->service_cat_id)->first();
        $service_name = $service_type->name.' - '.$client->first_name.' '.$client->last_name;
        return $service_name;
    }
    public function getEditLinkAttribute()
    {
        if (access()->allow('edit-task')) {
            return '<a class="btn btn-success btn-round" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.task.edit', $this).'">
                        <span class="material-icons">edit</span>
                    </a>';
        }
    }
}
