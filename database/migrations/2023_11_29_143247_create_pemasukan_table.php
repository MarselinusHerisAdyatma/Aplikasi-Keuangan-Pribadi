<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->increments('id');
        $table->unsignedInteger('users_id');
        $table->foreign('users_id')->references('id')->on('users');
        $table->string('nama_pemasukan');
        $table->string('kategori');
        $table->date('tanggal_pemasukan');
        $table->decimal('jumlah_pemasukan', 10, 2);
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
        Schema::dropIfExists('pemasukan');
    }
}
