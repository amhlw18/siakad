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
        Schema::create('model_matakuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurikulum_id');
            $table->foreignId('kode_prodi');
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->string('semester');
            $table->string('sks_teori');
            $table->string('sks_praktek');
            $table->string('sks_lapangan');
            $table->string('kelompok_mk');
            $table->string('jenis_kelompok');
            $table->string('jenis_mk');
            $table->string('status_mk');
            $table->string('silabus_mk');
            $table->string('sap_mk');
            $table->string('bahan_ajar');
            $table->string('diktat');
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
        Schema::dropIfExists('model_matakuliahs');
    }
};
