<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePlantasAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //crear nuevos campos registrada, altura ,registro y color
        Schema::table('plantas', function (Blueprint $table) {
            $table
                ->boolean('registrada')
                ->default(false)
                ->after('descripcion')
                ->nullable(); //esta registrada?
            $table
                ->integer('altura')
                ->default(0)
                ->after('registrada')
                ->nullable(); //altura max de la planta
            $table
                ->string('registro', 7)
                ->unique()
                ->after('altura')
                ->nullable(); //registro de la planta
            $table
                ->string('color', 7)
                ->after('registro')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //eliminar los campos creados
        Schema::table('plantas', function (Blueprint $table) {
            $table->dopColumn('registrada');
            $table->dopColumn('altura');
            $table->dropColumn('registro');
            $table->dopColumn('color');
        });
    }
}
