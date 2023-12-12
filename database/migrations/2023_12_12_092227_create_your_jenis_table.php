<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYourJenisTable extends Migration
{
    public function up()
    {
        Schema::create('your_jenis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_name'); // Example additional column
            // Add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('your_jenis');
    }
}
