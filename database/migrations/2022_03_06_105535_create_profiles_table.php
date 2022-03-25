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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dob')->nullable();
            $table->string('nickname')->nullable();
            $table->string('username_login');
            $table->string('email');
            $table->string('description')->nullable();
            $table->string('avatar');
            $table->string('address')->nullable();
            $table->string('phone');
            $table->integer('role_id')->default(3);
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
        Schema::dropIfExists('profiles');
    }
};
