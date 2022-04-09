<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_posts', function (Blueprint $table) {
            $table->foreignId('posts_id');
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_posts');
    }
};
