<?php

use Database\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Database\Seeders\Access\UserTableSeeder;
use Database\Seeders\Access\RoleTableSeeder;
use Database\Seeders\Access\PermissionTableSeeder;
use Database\Seeders\Access\PermissionRoleSeeder;
use Database\Seeders\Access\UserRoleSeeder;

/**
 * Class AccessTableSeeder.
 */
class AccessTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRoleSeeder::class);

        $this->enableForeignKeys();
    }
}
