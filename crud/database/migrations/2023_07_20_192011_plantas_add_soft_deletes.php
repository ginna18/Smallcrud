<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlantasAddSoftDeletes extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('plantas', function(Blueprint $table){
            $table->softDeletes();
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('plantas', function(Blueprint $table){
            $table->dropSoftDeletes();        //
    });
}
}
