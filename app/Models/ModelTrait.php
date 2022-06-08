<?php

namespace App\Models;

trait ModelTrait
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($permission, $route)
    {
        if (access()->allow($permission)) {
            return '<a href="'.route($route, $this).'" data-toggle="tooltip" data-placement="top" title="Edytuj" class="btn btn-round btn-success">
                    <span class="material-icons">edit</span>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($permission, $route)
    {
        if (access()->allow($permission)) {
            return '<a href="'.route($route, $this).'" data-toggle="tooltip" data-placement="top" title="Usuń" 
                    class="btn btn-round btn-danger" data-method="delete"
                    data-trans-button-cancel="Anuluj"
                    data-trans-button-confirm="Usuń"
                    data-trans-title="Czy jesteś pewny, że chcesz to zrobić ?">
                        <span class="material-icons">delete</span>
                </a>';
        }
    }
}
