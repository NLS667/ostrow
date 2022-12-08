<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientTableSeeder.
 */
class ClientTableSeeder extends Seeder
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
        $this->truncate('clients');

        $temp_client = [
            [
                'id'         => 1,
                'first_name'       => 'Janusz',
                'last_name' => 'Nosacz',
                'contacts' => '["G\u0142\u00f3wny"]',
                'emails' => '["nosacz@test.pl"]',
                'phones' => '["321456432"]',
                'adr_country' => 'Polska',
                'adr_region' => 'mazowieckie',
                'adr_zipcode' => '05-400',
                'adr_city' => 'Otwock',
                'adr_street' => 'Sobieskiego',
                'adr_street_nr' => '10',
                'adr_home_nr' => null,
                'adr_lattitude' => 52.113525200000000,
                'adr_longitude' => 52.120339950000000,
                'comm_adr_country' => 'Polska',
                'comm_adr_region' => 'mazowieckie',
                'comm_adr_zipcode' => '05-400',
                'comm_adr_city' => 'Otwock',
                'comm_adr_street' => 'Sobieskiego',
                'comm_adr_street_nr' => '10',
                'comm_adr_home_nr' => null,
                'extra_info' => 'brak',
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('clients')->insert($temp_client);

        $this->enableForeignKeys();
    }
}
