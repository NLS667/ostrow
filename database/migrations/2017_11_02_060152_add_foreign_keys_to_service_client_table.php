<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToServiceClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_client', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_client', function (Blueprint $table) {
            $table->dropForeign('service_client_service_id_foreign');
            $table->dropForeign('service_client_client_id_foreign');
        });
    }
}
