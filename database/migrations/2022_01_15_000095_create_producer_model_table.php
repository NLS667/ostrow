<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducerModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producer_model', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producer_id')->unsigned()->index('producer_model_producer_id_foreign');
            $table->integer('model_id')->unsigned()->index('producer_model_model_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producer_model');
    }
}
