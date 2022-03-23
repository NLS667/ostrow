<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.users_table'));

        $users = [
            [
                'first_name'        => 'Sebastian',
                'last_name'         => 'Kosk',
                'email'             => 'sebastian.kosk@radspzoo.pl',
                'email_verified_at' => now(),
                'password'          => bcrypt('123qwe666'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => null,
                'deleted_at'        => null,
            ],
            [
                'first_name'        => 'Biuro',
                'last_name'         => 'RAD',
                'email'             => 'sekretariat@radspzoo.pl',
                'email_verified_at' => now(),
                'password'          => bcrypt('1234qwer'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => null,
                'deleted_at'        => null,
            ],
            [
                'first_name'        => 'User',
                'last_name'         => 'Test',
                'email'             => 'test@uroczysko.org',
                'password'          => bcrypt('1234qwer'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => null,
                'deleted_at'        => null,
            ],
        ];

        DB::table(config('access.users_table'))->insert($users);

        $this->enableForeignKeys();
    }
}
