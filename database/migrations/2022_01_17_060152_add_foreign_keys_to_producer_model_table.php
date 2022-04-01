<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProducerModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producer_model', function (Blueprint $table) {
            $table->foreign('producer_id')->references('id')->on('producers')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('model_id')->references('id')->on('models')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producer_model', function (Blueprint $table) {
            $table->dropForeign('producer_model_producer_id_foreign');
            $table->dropForeign('producer_model_model_id_foreign');
        });
    }
}
