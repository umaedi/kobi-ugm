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
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->string('01')->nullable();
            $table->string('02')->nullable();
            $table->string('03')->nullable();
            $table->string('04')->nullable();
            $table->string('05')->nullable();
            $table->string('06')->nullable();
            $table->string('07')->nullable();
            $table->string('08')->nullable();
            $table->string('09')->nullable();
            $table->string('10')->nullable();
            $table->string('11')->nullable();
            $table->string('12')->nullable();
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
        Schema::dropIfExists('pengunjungs');
    }
};
