<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Processo>
 */
class ProcessoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero'=>$this->faker->unique()->randomElement(array('13219/2024','14000/2024','11000/2024','18000/2024')),
            'valor'=>$this->faker->numberBetween(15000,90000),  
            'descricao'=>$this->faker->unique()->randomElement(array('Mobília Escolar','Expediente','Extintores','Uniforme')),
        ];
    }
}
