<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgprdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgprds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('prd_id')->unsigned();
            $table->foreign('prd_id')->references('prd_id')->on('products');
            $table->string('img');
            

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imgprds');
    }
}
