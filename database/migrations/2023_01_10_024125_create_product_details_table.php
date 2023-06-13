<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->bigIncrements('prd_detail_id');
            $table->bigInteger('prd_id')->unsigned();
            $table->foreign('prd_id')->references('prd_id')->on('product');
            
            $table->string('prd_image');
            $table->string('prd_color');
            $table->integer('prd_size');
            
            $table->integer('prd_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
