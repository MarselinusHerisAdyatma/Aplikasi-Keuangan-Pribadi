<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            // Use 'unsignedBigInteger' instead of 'unsignedInteger'
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('nama_orang'); // Ensure 'nama_orang' column is defined as a string
            $table->string('kategori');
            $table->integer('nominal_hutang');
            $table->date('tanggal_hutang');
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
        // Specify the foreign key name in the drop method

        Schema::dropIfExists('hutang');
    }
}
