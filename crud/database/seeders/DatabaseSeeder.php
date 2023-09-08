<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\planta;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        User::factory(50)->create();//crea 50 usuarios
        Planta::factory(200)->create();//crea 200 plantas
        // \App\Models\User::factory(10)->create();
    }
}
