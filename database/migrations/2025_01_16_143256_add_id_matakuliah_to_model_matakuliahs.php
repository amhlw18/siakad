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
        Schema::table('model_matakuliahs', function (Blueprint $table) {
            //
            $table->string('id_matakuliah')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_matakuliahs', function (Blueprint $table) {
            //
            $table->dropColumn('id_matakuliah');
        });
    }
};
