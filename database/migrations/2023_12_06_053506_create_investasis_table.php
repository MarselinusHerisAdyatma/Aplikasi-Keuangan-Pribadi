<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('id_jenis');
            $table->unsignedInteger('id_kategori');
            $table->enum('investasi', ['beli', 'jual']);
            $table->string('nama_investasi');
            $table->string('nama_bank');
            $table->date('date');
            $table->time('time');
            $table->decimal('nominal_modal', 15, 2);
            $table->decimal('nominal_investasi', 15, 2);
            $table->unsignedInteger('jumlah');
            $table->enum('status', ['Loss', 'Profit']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_jenis')->references('id')->on('your_jenis_table');
            $table->foreign('id_kategori')->references('id')->on('your_kategori_table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investasis');
    }
}
