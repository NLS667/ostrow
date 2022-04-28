<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('type_id')->constrained('history_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreignId('user_id')->constrained('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->integer('entity_id')->unsigned()->nullable();
            $table->string('icon', 191)->nullable();
            $table->string('class', 191)->nullable();
            $table->string('text', 191);
            $table->text('assets', 65535)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('history');
    }
}
