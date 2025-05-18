<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('alumno_materia', function (Blueprint $table) {
            $table->unsignedTinyInteger('semestre')->after('materia_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('alumno_materia', function (Blueprint $table) {
            $table->dropColumn('semestre');
        });
    }
};
