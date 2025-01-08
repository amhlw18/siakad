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
        Schema::table('model_status_k_r_s', function (Blueprint $table) {
            //
            $table->string('prodi_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_status_k_r_s', function (Blueprint $table) {
            //
            $table->dropColumn('prodi_id');
        });
    }
};
