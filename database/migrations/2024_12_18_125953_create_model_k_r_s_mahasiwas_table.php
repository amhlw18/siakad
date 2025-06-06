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
        Schema::create('model_k_r_s_mahasiwas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik');
            $table->foreignId('prodi_id');
            $table->string('matakuliah_id');
            $table->foreignId('nim');
            $table->boolean('dikunci')->default(false);
            $table->boolean('disetujui')->default(false);
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
        Schema::dropIfExists('model_k_r_s_mahasiwas');
    }
};
