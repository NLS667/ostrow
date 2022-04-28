<?php

namespace App\Events\Access\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionDeleted.
 */
class PermissionDeleted
{
    use SerializesModels;

    /**
     * @var object $permission
     */
    public $permission;

    /**
     * @param $permission
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
    }
}
