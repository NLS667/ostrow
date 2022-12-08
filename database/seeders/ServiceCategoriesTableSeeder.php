<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\ServiceCategoryTypeEnum;

/**
 * Class ServiceCategoriesTableSeeder.
 */
class ServiceCategoriesTableSeeder extends Seeder
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
        $this->truncate('service_categories');

        $default_service_categories = [
            [
                'id'         => 1,
                'name'       => 'Pompa ciepła',
                'type'       => ServiceCategoryTypeEnum::Normal,
                'short_name' => 'PC',
                'description' => 'Usługa/produkt o nazwie Pompa ciepła',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'Fotowoltaika',
                'type'       => ServiceCategoryTypeEnum::Normal,
                'short_name' => 'PV',
                'description' => 'Usługa/produkt o nazwie Fotowoltaika',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 3,
                'name'       => 'Klimatyzacja',
                'type'       => ServiceCategoryTypeEnum::Normal,
                'short_name' => 'AC',
                'description' => 'Usługa/produkt o nazwie Klimatyzacja',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 4,
                'name'       => 'Rekuperacja',
                'type'       => ServiceCategoryTypeEnum::Normal,
                'short_name' => 'OP',
                'description' => 'Usługa/produkt o nazwie Rekuperacja',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id'         => 5,
                'name'       => 'Dofinansowanie',
                'type'       => ServiceCategoryTypeEnum::Addon,
                'short_name' => '$$',
                'description' => 'Usługa/produkt o nazwie Dofinansowanie',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('service_categories')->insert($default_service_categories);

        $this->enableForeignKeys();
    }
}
