<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ModulesTableSeeder.
 */
class ModulesTableSeeder extends Seeder
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
        $this->truncate(config('access.modules_table'));

        $types = [
            [
                'id'         => 1,
                'view_permission_id' => 'view-access-management',
                'name'       => 'Ustawienia Dostępu',
                'url'        => null,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 1,
                'view_permission_id' => 'view-user-management',
                'name'       => 'Użytkownicy',
                'url'        => 'admin.access.user.index',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 1,
                'view_permission_id' => 'view-role-management',
                'name'       => 'Role',
                'url'        => 'admin.access.role.index',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 1,
                'view_permission_id' => 'view-permission-management',
                'name'       => 'Uprawnienia',
                'url'        => 'admin.access.permission.index',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 1,
                'view_permission_id' => 'view-menu',
                'name'       => 'Ustawienia Menu',
                'url'        => 'admin.menus.index',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table(config('access.modules_table'))->insert($types);

        $this->enableForeignKeys();
    }
}
