<?php

namespace App\Events\Access\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionCreated.
 */
class PermissionCreated
{
    use SerializesModels;

    /**
     * @var object $permission 
     */
    public $permission;

    /**
     * @param object $permission
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
    }
}
