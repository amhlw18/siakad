<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_nilai_m_h_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik');
            $table->string('matakuliah_id');
            $table->foreignId('nim');
            $table->string('total_nilai');
            $table->string('nilai_angka');
            $table->string('nilai_huruf');
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
        Schema::dropIfExists('model_nilai_m_h_s');
    }
};
