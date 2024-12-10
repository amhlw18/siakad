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
        Schema::create('model_kelas_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id');
            $table->foreignId('kelas_id');
            $table->foreignId('nim');
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
        Schema::dropIfExists('model_kelas_mahasiswas');
    }
};
