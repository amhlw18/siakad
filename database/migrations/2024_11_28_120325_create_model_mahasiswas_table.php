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
        Schema::create('model_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id');
            $table->foreignId('semester_masuk');
            $table->string('nim');
            $table->string('nama_mhs');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('NIK');
            $table->string('alamat');
            $table->string('status_masuk')->nullable();
            $table->string('program')->nullable();
            $table->string('tahun_masuk');
            $table->string('status');
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
        Schema::dropIfExists('model_mahasiswas');
    }
};
