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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('content');
            $table->foreignId('writer_id');
            $table->timestamps();

            $table->foreign('writer_id') //cột khóa ngoại là cột `l_ma` trong table `sanpham`
            ->references('id')->on('users') //cột sẽ tham chiếu đến là cột `l_ma` trong table `loai`
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
