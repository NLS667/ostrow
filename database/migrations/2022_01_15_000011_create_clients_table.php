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
            $table->bigIncrements('id');
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->longText('emails')->nullable();
            $table->longText('phones', 191)->nullable();
            $table->string('adr_country', 191)->nullable();
            $table->string('adr_region', 191)->nullable();
            $table->string('adr_zipcode', 191)->nullable();
            $table->string('adr_city', 191)->nullable();
            $table->string('adr_street', 191)->nullable();
            $table->string('adr_street_nr', 191)->nullable();
            $table->string('adr_home_nr', 191)->nullable();
            $table->double('adr_lattitude', 18, 15)->nullable();
            $table->double('adr_longitude', 18, 15)->nullable();
            $table->string('comm_adr_country', 191)->nullable();
            $table->string('comm_adr_region', 191)->nullable();
            $table->string('comm_adr_zipcode', 191)->nullable();
            $table->string('comm_adr_city', 191)->nullable();
            $table->string('comm_adr_street', 191)->nullable();
            $table->string('comm_adr_street_nr', 191)->nullable();
            $table->string('comm_adr_home_nr', 191)->nullable();
            $table->longText('extra_info');
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
