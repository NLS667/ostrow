<?php

use App\Models\Access\Role\Role;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.permission_role_table'));

        /*
         * Assign permissions to admin role
        */
        $administrator = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 ,21, 22, 27, 28, 29, 30, 31 ];

        /*
         *  Assign permissions to employee role
        */
        $employee = [1, 24, 48, 52, 53];

        Role::find(2)->permissions()->sync($administrator);
        Role::find(3)->permissions()->sync($employee);
        
        $this->enableForeignKeys();
    }
}
