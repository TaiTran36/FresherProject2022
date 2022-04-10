<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_dislikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->foreignId('user_id');
            $table->smallInteger('like')->default(0);
            $table->smallInteger('dislike')->default(0);
            $table->timestamps();
            $table->foreign('post_id') 
            ->references('id')->on('posts') 
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreign('user_id') 
            ->references('id')->on('users') 
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
