<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jenis');
            $table->timestamps();
        });

        // Tambahkan data jenis transaksi
        DB::table('jenis_transaksi')->insert([
            ['nama_jenis' => 'pemasukan'],
            ['nama_jenis' => 'pengeluaran'],
            ['nama_jenis' => 'tabungan'],
            ['nama_jenis' => 'hutang'],
            ['nama_jenis' => 'investasi'],
            ['nama_jenis' => 'asuransi'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_transaksi');
    }
}
