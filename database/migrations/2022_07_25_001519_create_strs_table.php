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
        Schema::create('strs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('program_studi');
            $table->string('universitas');
            $table->string('no_hp');
            $table->string('email');
            $table->string('nama_perusahaan');
            $table->string('ijazah');
            $table->string('surat_permohonan');
            $table->string('surat_pengantar');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('strs');
    }
};
