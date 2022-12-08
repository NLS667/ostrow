<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ProducerTableSeeder.
 */
class ProducerTableSeeder extends Seeder
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
        $this->truncate('producers');

        $default_producers = [
            [
                'id'         => 1,
                'name'       => 'Mitsubishi',
                'description' => 'Japoński producent elektroniki.',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'Viessmann',
                'description' => 'Niemiecki producent systemów grzewczych.',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 3,
                'name'       => 'Daikin',
                'description' => 'Japoński producent klimatyzacji.',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('producers')->insert($default_producers);

        $this->enableForeignKeys();
    }
}
