<?php

namespace Database\Factories;

use App\Models\planta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planta>
 */
class PlantaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'categoria'=>$this->faker->randomElement([
                'hierbas','arbustos','matas','arboles']),
            'tipo'=>$this->faker->word(),
            'nombres'=>$this->faker->text(),
            'nombrec'=>$this->faker->text(),
            'descripcion'=>$this->faker->text()   //
        ];
    }
}
