<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('client_id')->constrained('clients');            
            $table->string('type')->default('extended');            
            $table->foreignId('service_cat_id')->constrained('service_categories');
            $table->longText('models')->nullable();
            $table->date('offered_at')->nullable();
            $table->date('signed_at')->nullable();
            $table->date('installed_at')->nullable();
            $table->decimal('deal_amount', 10, 2)->nullable()->default('0.00');
            $table->longText('advance_date');
            $table->longText('deal_advance');
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
        Schema::drop('services');
    }
}
