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
        //
        Schema::table('users', function (Blueprint $table) {
            // Menghapus constraint unique pada kolom email
            $table->dropUnique(['email']);

            // Pastikan kolom email tetap ada tanpa unique constraint
            $table->string('email')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom email menjadi unik
            $table->string('email')->unique()->change();
        });
    }
};
