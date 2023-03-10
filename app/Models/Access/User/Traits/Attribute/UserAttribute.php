<?php

namespace App\Models\Access\User\Traits\Attribute;

/**
 * Class UserAttribute.
 */
trait UserAttribute
{
    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return !app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @return bool
     */
    public function isAdmin() {
       return $this->roles()->where('roles.id','<', 2)->exists();
    }

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
     * @return string
     */
    public function getConfirmedLabelAttribute()
    {
        if ($this->isConfirmed()) {
            return "<label class='badge badge-success'>Tak</label>";
        }

        return "<label class='badge badge-danger'>Nie</label>";
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @param bool $size
     *
     * @return mixed
     */
    public function getPicture($size = false)
    {
        if (!$size) {
            $size = config('gravatar.default.size');
        }

        return gravatar()->get($this->email, ['size' => $size]);
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed == 1;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute($class)
    {
        if (access()->allow('show-user')) {
            return '<a class="'.$class.'"  data-toggle="tooltip" data-placement="top" title="Zobacz" href="'.route('admin.access.user.show', $this).'">
                        <span class="material-icons">visibility</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Edytuj" href="'.route('admin.access.user.edit', $this).'">
                        <span class="material-icons">edit</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getChangePasswordButtonAttribute($class)
    {
        if (access()->user()->id == $this->id && access()->allow('edit-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Zmień Hasło" href="'.route('admin.access.user.change-password', $this).'">
                        <span class="material-icons">sync</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute($class)
    {
        if ($this->id != access()->id()) {
            switch ($this->status) {
                case 0:
                    if (access()->allow('activate-user')) {
                        $name = ($class == '' || $class == 'dropdown-item') ? 'Aktywuj' : '';

                        return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Aktywuj" href="'.route('admin.access.user.mark', [$this, 1]).'"><span class="material-icons">lock_open</span>'.$name.'</a>';
                    }
                    break;

                case 1:
                    if (access()->allow('deactivate-user')) {
                        $name = ($class == '' || $class == 'dropdown-item') ? 'Deaktywuj' : '';

                        return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Deaktywuj" href="'.route('admin.access.user.mark', [$this, 0]).'"><span class="material-icons">lock</span>'.$name.'</a>';
                    }
                    break;

                default:
                    return '';
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getConfirmedButtonAttribute($class)
    {
        if (!$this->isConfirmed() && access()->allow('edit-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Wyślij ponownie" href="'.route('admin.access.user.account.confirm.resend', $this).'">
                        <span class="material-icons">sync_alt</span>
                    </a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if ($this->id != access()->id() && access()->allow('delete-user')) {
            $name = ($class == '' || $class == 'dropdown-item') ? 'Usuń' : '';

            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń" href="'.route('admin.access.user.destroy', $this).'"
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
    public function getRestoreButtonAttribute($class)
    {
        if (access()->allow('delete-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Przywróć Użytkownika" href="'.route('admin.access.user.restore', $this).'" name="restore_user">
                        <span class="material-icons">sync_alt</span>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute($class)
    {
        return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Usuń permanetnie" href="'.route('admin.access.user.delete-permanently', $this).'" name="delete_user_perm">
                    <span class="material-icons">delete</span>
                </a>';
    }

    /**
     * @return string
     */
    public function getLoginAsButtonAttribute($class)
    {
        $name = ($class == '' || $class == 'dropdown-item') ? 'Zaloguj jako' : '';
        /*
         * If the admin is currently NOT spoofing a user
         */
        if (access()->allow('login-as-user') && (!session()->has('admin_user_id') || !session()->has('temp_user_id'))) {
            //Won't break, but don't let them "Login As" themselves
            if ($this->id != access()->id()) {
                return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Zaloguj jako" href="'.route('admin.access.user.login-as',
                    $this).'"><span class="material-icons">login</span>'.$name.'</a>';
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getClearSessionButtonAttribute($class)
    {
        $name = ($class == '' || $class == 'dropdown-item') ? 'Wyczyść Sesję' : '';

        if ($this->id != access()->id() && config('session.driver') == 'database' && access()->allow('clear-user-session')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" title="Wyczyść Sesję" href="'.route('admin.access.user.clear-session', $this).'"
			 	 data-trans-button-cancel="Anuluj"
                 data-trans-button-confirm="Dalej"
                 data-trans-title="Czy na pewno ?"
                 name="confirm_item"><span class="material-icons">clear</span>'.$name.'</a>';
        }

        return '';
    }

    public function checkAdmin()
    {
        if ($this->id != 1) {
            return $this->getDeleteButtonAttribute('btn btn-danger btn-round').'
                   '.$this->getStatusButtonAttribute('btn btn-warning btn-round').'
                   '.$this->getClearSessionButtonAttribute('btn btn-rose btn-round').'
                   '.$this->getLoginAsButtonAttribute('btn btn-primary btn-round');
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
        $attributePermission = ['7', '9', '10', '11', '12', '13', '14'];
        foreach (access()->user()->permissions as $permission) {
            if (in_array($permission->id, $attributePermission)) {
                $userPermission[] = $permission->name;
            }
        }

        return $userPermission;
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
        switch ($permissionName) {
            case 'show-user':
                $button = $this->getShowButtonAttribute('btn btn-info btn-round');
                break;
            case 'edit-user':
                $button = $this->getEditButtonAttribute('btn btn-success btn-round');
                $button .= $this->getChangePasswordButtonAttribute('btn btn-primary btn-round');
                break;
            case 'activate-user':
                if (\Route::currentRouteName() == 'admin.access.user.deactivated.get') {
                    $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'deactivate-user':
                if (\Route::currentRouteName() == 'admin.access.user.get') {
                    $button = $this->getStatusButtonAttribute('btn btn-warning btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'delete-user':
                if (access()->user()->id != $this->id) {
                    $button = $this->getDeleteButtonAttribute('btn btn-danger btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'login-as-user':
                if (access()->user()->id != $this->id) {
                    $button = $this->getLoginAsButtonAttribute('btn btn-primary btn-round');
                } else {
                    $button = '';
                }
                break;
            case 'clear-user-session':
                if (access()->user()->id != $this->id) {
                    $button = $this->getClearSessionButtonAttribute('btn btn-rose btn-round');
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
                    '.$this->getChangePasswordButtonAttribute('btn btn-primary btn-round').'
                    '.$this->checkAdmin();
        } else {
            $userPermission = $this->getUserPermission();
            $permissionCounter = count($userPermission);
            $actionButton = '';
            $i = 1;

            if (access()->user()->id == $this->id) {
                if (in_array('clear-user-session', $userPermission)) {
                    $permissionCounter = $permissionCounter - 1;
                }

                if (in_array('login-as-user', $userPermission)) {
                    $permissionCounter = $permissionCounter - 1;
                }

                if (in_array('delete-user', $userPermission)) {
                    $permissionCounter = $permissionCounter - 1;
                }

                if (in_array('deactivate-user', $userPermission)) {
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
                            <ba class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
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
}
