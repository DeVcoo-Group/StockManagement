<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockcontrol', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->double('price');
            $table->integer('qty');
            $table->integer('type');
            $table->integer('refreturn')->nullable();
            $table->foreign('refreturn')->references('id')->on('stockcontrol');
            $table->integer('refpro')->unsigned();
            $table->foreign('refpro')->references('id')->on('product');
            $table->integer('refsup')->unsigned();
            $table->foreign('refsup')->references('id')->on('supplier');
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
        Schema::drop('stockcontrol');
    }
}
