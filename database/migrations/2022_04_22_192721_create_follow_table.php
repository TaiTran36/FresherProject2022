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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('writer_id');
            $table->foreign('user_id') 
            ->references('id')->on('users') 
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreign('writer_id') 
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
