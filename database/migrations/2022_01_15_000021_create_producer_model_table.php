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
            $table->foreignId('producer_id')->constrained('producers')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreignId('model_id')->constrained('models')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
