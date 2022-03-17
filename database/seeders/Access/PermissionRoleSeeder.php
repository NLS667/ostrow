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
        //$this->truncate(config('access.permission_role_table'));

        /*
         * Assign permissions to manager role
        */
        $manager = [2, 28, 29, 30, 31, 32 ];

        /*
         *  Assign permissions to serviceman role
        */
        $serviceman = [1, 2, 3, 4, 5, 6, 7, 8, 12, 13, 14, 16, 20, 28, 29, 30, 32 ];

        //Role::find(2)->permissions()->sync($exec);
        //Role::find(3)->permissions()->sync($user);
        $this->enableForeignKeys();
    }
}
