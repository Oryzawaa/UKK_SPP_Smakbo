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
        Schema::create('view_bayar', function (Blueprint $table) {
            $table->id();
            $table->string('name_petugas');
            $table->string('nisn');
            $table->string('nis');
            $table->string('nama');
            $table->string('kelas');
            $table->string('alamat');
            $table->string('no_telp');
            $table->date('tgl_bayar');
            $table->string('bulan_dibayar');
            $table->string('tahun_dibayar');
            $table->string('jumlah_bayar');
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
        Schema::dropIfExists('view_bayar');
    }
};
