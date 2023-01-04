<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('Kriterias', function (Blueprint $table) {
            $table->string('kode_kriteria', 10)->primary();
            $table->string('nama_kriteria', 50);
            $table->string('atribut', 10);
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
        Schema::dropIfExists('Kriterias');
    }
}
