<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191);
            $table->string('phone_nr', 191)->unique()->nullable();
            $table->string('adr_country', 191)->unique()->nullable();
            $table->string('adr_region', 191)->unique()->nullable();
            $table->string('adr_zipcode', 191)->unique()->nullable();
            $table->string('adr_city', 191)->unique()->nullable();
            $table->string('adr_street', 191)->unique()->nullable();
            $table->string('adr_street_nr', 191)->unique()->nullable();
            $table->string('adr_home_nr', 191)->unique()->nullable();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
