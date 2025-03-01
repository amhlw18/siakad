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
        Schema::create('model_dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nidn');
            $table->string('nama_dosen');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('alamat');
            $table->string('tgl_kerja')->nullable();
            $table->string('ikatan_kerja')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('status')->nullable();
            $table->string('jabatan_akademik')->nullable();
            $table->string('jabatan_struktural')->nullable();
            $table->string('golongan')->nullable();
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
        Schema::dropIfExists('model_dosens');
    }
};
