<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        //$this->call(SettingsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(ModulesTableSeeder::class);

        Model::reguard();
    }
}