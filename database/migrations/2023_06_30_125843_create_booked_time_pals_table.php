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
        Schema::create('booked_time_pals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pal_id');
            $table->foreign('pal_id')->references('id')->on('pals');
            $table->unsignedBigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('times');
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
        Schema::dropIfExists('booked_time_pals');
    }
};
