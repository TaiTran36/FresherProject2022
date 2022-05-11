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
        
        Schema::create('newletter', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('user_author');
            // $table->foreignId('user_subscribe');
            // $table->timestamps();
            // $table->foreign('user_author')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            // $table->foreign('user_subscribe')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->id();
            $table->string('email');
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
        //
    }
};
