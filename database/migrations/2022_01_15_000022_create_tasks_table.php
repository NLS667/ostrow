<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->foreignId('assignee_id')->constrained('users')->nullable();
            $table->foreignId('service_id')->constrained('services');
            $table->integer('status')->default(0);
            $table->dateTime('start');
            $table->dateTime('end')->nullable(); 
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();           
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
        Schema::dropIfExists('tasks');
    }
}