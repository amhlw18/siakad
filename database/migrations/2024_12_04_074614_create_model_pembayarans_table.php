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
        Schema::create('model_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_pembayaran')->default(DB::raw('(UUID())'));
            $table->foreignId('tahun_akademik');
            $table->foreignId('nim');
            $table->foreignId('prodi_id');
            $table->boolean('is_bayar')->default(false);
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
        Schema::dropIfExists('model_pembayarans');
    }
};
