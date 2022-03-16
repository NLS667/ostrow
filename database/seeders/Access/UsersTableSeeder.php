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

        DB::table('users')->insert([
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
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null,
        ]);

        $this->enableForeignKeys();
    }
}
