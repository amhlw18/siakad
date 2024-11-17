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
        Schema::create('model_kurikulums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id');
            $table->string('kode_kurikulum')->unique();
            $table->string('nama_kurikulum')->unique();
            //$table->string('prodi');
            $table->string('sks_wajib');
            $table->string('sks_pilihan');
            $table->string('jumlah_sks');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('model_kurikulums');
    }
};
