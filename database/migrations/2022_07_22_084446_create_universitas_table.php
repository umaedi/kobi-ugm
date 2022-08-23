<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universitas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_univ');
            $table->string('nama_kajur');
            $table->string('nama_jurusan');
            $table->string('email_kaprodi');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('no_tlp');
            $table->string('no_wa');
            $table->string('kode_pos');
            $table->string('no_anggota');
            $table->string('bukti_pembayaran');
            $table->boolean('verifikasi')->default(false);
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
        Schema::dropIfExists('universitas');
    }
};
