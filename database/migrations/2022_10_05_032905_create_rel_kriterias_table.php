<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelKriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('rel_kriterias', function (Blueprint $table) {
            $table->increments('id_rel_kriterias', 10);
            $table->string('id1');
            $table->string('id2');
            $table->double('nilai');
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
        Schema::dropIfExists('rel_kriterias');
    }
}
