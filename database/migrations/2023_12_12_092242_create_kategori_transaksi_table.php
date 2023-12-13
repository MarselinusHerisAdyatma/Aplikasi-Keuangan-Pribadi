<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_transaksi', function (Blueprint $table) {
            $table->increments('id');
            // Tambahkan kolom-kolom lain sesuai kebutuhan
            $table->unsignedInteger('jenis_transaksi_id')->nullable();
            $table->string('nama_kategori');
            $table->timestamps();

            $table->foreign('jenis_transaksi_id')->references('id')->on('jenis_transaksi')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_transaksi');
    }
}
