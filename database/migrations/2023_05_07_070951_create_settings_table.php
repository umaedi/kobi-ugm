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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default('logo.png');
            $table->string('nama_web')->default('Konsorsium Biologi Indonesia');
            $table->text('tentang_web')->default('Belum ada informasi');
            $table->text('alamat')->default('Belum ada informasi');
            $table->string('photo_ketua')->default('photo_ketua.png');
            $table->string('text_footer')->default('Belum ada informasi');
            $table->string('no_tlp')->nullable();
            $table->string('email')->nullable();
            $table->string('ytb')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tweeter')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
