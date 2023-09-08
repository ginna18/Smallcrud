<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePlantasAddImageField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('plantas', function(Blueprint $table){
            //crear el campo imagen en la tabla plantas
            $table->string('imagen',255)
                  ->after('descripcion')
                  ->nullable();  
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('plantas', function(Blueprint $table){
            //eliminar el campo de imagen en la tabla plantas
            $table->dropColumn('imagen');
        });//
    }
};
