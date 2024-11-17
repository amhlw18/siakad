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
        Schema::create('model_tahun_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('tahun_akademik');
            $table->string('semester');
            $table->string('periode_pembayaran');
            $table->string('periode_perkuliahan');
            $table->string('periode_krs');
            $table->string('periode_penilaian');
            $table->string('periode_uts');
            $table->string('periode_uas');
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
        Schema::dropIfExists('model_tahun_akademiks');
    }
};
