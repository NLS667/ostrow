<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class TaskTypesTableSeeder.
 */
class TaskTypesTableSeeder extends Seeder
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
        $this->truncate('task_types');

        $default_task_types = [
            [
                'id'         => 1,
                'name'       => 'Montaż',
                'description' => 'Montaż urządzeń',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'Serwis',
                'description' => 'Serwis zamontowanych urządzeń',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 3,
                'name'       => 'Awaria',
                'description' => 'Awaria zamontowanych urządzeń',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('task_types')->insert($default_task_types);

        $this->enableForeignKeys();
    }
}
