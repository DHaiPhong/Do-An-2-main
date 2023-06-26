<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('category_blog_id'); // Khóa ngoại để liên kết với Category_blogs
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('status');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('category_blog_id')->references('id')->on('category_blogs')->cascadeOnDelete(); // Thiết lập khóa ngoại
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
