<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('users_id');
            $table->string('nama_pengeluaran');
            $table->string('kategori');
            $table->date('tanggal_pengeluaran');
            $table->decimal('jumlah_pengeluaran', 10, 2);
            $table->timestamps();

            // Definisikan relasi foreign key
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
}
