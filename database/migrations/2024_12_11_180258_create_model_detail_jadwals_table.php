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
        Schema::create('model_detail_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id');
            $table->foreignId('tahun_akademik');
            $table->string('matakuliah_id');
            $table->string('nidn');
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('ruangan_id')->nullable();
            $table->string('hari')->nullable();
            $table->string('jam')->nullable();
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
        Schema::dropIfExists('model_detail_jadwals');
    }
};
