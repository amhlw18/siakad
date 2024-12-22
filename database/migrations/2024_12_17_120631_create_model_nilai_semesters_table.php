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
        Schema::create('model_nilai_semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik');
            $table->string('matakuliah_id');
            $table->foreignId('aspek_id');
            $table->foreignId('nim');
            $table->string('nilai');
            $table->string('nilai_angka');
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
        Schema::dropIfExists('model_nilai_semesters');
    }
};
