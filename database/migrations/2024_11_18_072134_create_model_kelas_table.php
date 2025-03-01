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
        Schema::create('model_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id');
            $table->string('nama_kelas');
            $table->string('program');
            $table->string('kapasitas');
            $table->boolean('aktif')->default(false);
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
        Schema::dropIfExists('model_kelas');
    }
};
