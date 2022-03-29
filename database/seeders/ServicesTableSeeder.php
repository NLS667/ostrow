<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ServicesTableSeeder.
 */
class ServicesTableSeeder extends Seeder
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
        $this->truncate('services');

        $default_services = [
            [
                'id'         => 1,
                'name'       => 'Pompa ciepła',
                'description' => 'Usługa/produkt o nazwie Pompa ciepła',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'Fotowoltaika',
                'description' => 'Usługa/produkt o nazwie Fotowoltaika',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 3,
                'name'       => 'Klimatyzacja',
                'description' => 'Usługa/produkt o nazwie Klimatyzacja',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 4,
                'name'       => 'Rekuperacja',
                'description' => 'Usługa/produkt o nazwie Rekuperacja',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('services')->insert($default_services);

        $this->enableForeignKeys();
    }
}
