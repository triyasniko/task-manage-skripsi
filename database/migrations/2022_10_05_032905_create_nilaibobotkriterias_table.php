<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaibobotkriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('NilaiBobotKriterias', function (Blueprint $table) {
            $table->string('id_nilai_bobot_kriteria', 10)->primary();
            $table->string('kode_kriteria1');
            $table->string('kode_kriteria2');
            $table->string('nilai_bobot_kriteria');
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
        Schema::dropIfExists('NilaiBobotKriterias');
    }
}
