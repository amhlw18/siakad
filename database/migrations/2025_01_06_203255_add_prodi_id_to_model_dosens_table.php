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
        Schema::table('model_dosens', function (Blueprint $table) {
            //
            $table->foreignId('prodi_id')->after('nidn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_dosens', function (Blueprint $table) {
            //
            $table->dropColumn('prodi_id');
        });
    }
};
