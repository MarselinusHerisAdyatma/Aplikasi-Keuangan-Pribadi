<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYourKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('your_kategori', function (Blueprint $table) {
            $table->increments('id');
            // Tambahkan kolom-kolom lain sesuai kebutuhan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('your_kategori');
    }
}
