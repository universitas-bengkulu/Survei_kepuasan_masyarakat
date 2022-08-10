<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiRekapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_rekaps', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('nama_lengkap');
            $table->string('akses');
            $table->string('prodi');
            $table->string('fakultas');
            $table->integer('total_skor');
            $table->double('rata_rata');
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
        Schema::dropIfExists('evaluasi_rekaps');
    }
}
