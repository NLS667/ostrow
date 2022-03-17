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
            return '<a href="'.route($route, $this).'" class="btn btn-flat btn-success">
                    <i data-toggle="tooltip" data-placement="top" title="Edytuj" class="fas fa-pencil-alt"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($permission, $route)
    {
        if (access()->allow($permission)) {
            return '<a href="'.route($route, $this).'" 
                    class="btn btn-flat btn-danger" data-method="delete"
                    data-trans-button-cancel="Anuluj"
                    data-trans-button-confirm="Usuń"
                    data-trans-title="Czy jesteś pewny, że chcesz to zrobić ?">
                        <i data-toggle="tooltip" data-placement="top" title="Usuń" class="fas fa-trash"></i>
                </a>';
        }
    }
}
