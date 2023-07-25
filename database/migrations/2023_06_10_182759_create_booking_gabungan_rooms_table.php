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
        Schema::create('booking_gabungan_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_users');
            $table->string('time');
            $table->string('date');
            $table->string('status');
            $table->string('nama_pal')->nullable();
            $table->string('nama_rooms')->nullable();
            $table->string('jurusan')->nullable();
            $table->boolean('is_aviailable')->default('1');
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
        Schema::dropIfExists('booking_gabungan_rooms');
    }
};
