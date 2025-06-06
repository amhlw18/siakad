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
        Schema::create('model_aspek_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('matakuliah_id');
            $table->string('nidn');
            $table->string('nama_dosen');
            $table->string('aspek');
            $table->string('bobot');
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
        Schema::dropIfExists('model_aspek_penilaians');
    }
};
