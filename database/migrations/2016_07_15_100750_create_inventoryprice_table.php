<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorypriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventoryprice', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->integer('qty');
            $table->timestamps();
        });

        Schema::create('inv_invprice', function(Blueprint $table) {
              $table->integer('inventory_id')->unsigned()->nullable();
              $table->foreign('inventory_id')->references('id')
                      ->on('inventory')->onDelete('cascade');

              $table->integer('inventoryprice_id')->unsigned()->nullable();
              $table->foreign('inventoryprice_id')->references('id')
                      ->on('inventoryprice')->onDelete('cascade');
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
        Schema::drop('inv_invprice');
        Schema::drop('inventoryprice');
    }
}
