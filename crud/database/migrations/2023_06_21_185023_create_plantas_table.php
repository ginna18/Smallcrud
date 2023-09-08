<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->id();
            $table->string('categoria',255);//cat segun tamaño
            $table->string('tipo',255); //con flor, semilla, sin flor semilla
            $table->string('nombres',255);//nombre silvestre
            $table->string('nombrec',255);//nombre cientifico
            $table->string('descripcion',255);//descripcion si es fruto, originario, etc...
            
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
        Schema::dropIfExists('plantas');
    }
};
