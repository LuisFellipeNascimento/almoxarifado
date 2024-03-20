<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdensFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_ordem'=>$this->faker->randomElement(array('112/2024','144/2024','116/2024','200/2024')),
           'emissao'=>$this->faker->dateTimeInInterval('+3 weeks'),
            'empenho'=>$this->faker->numerify('###/##'),
            'item'=>$this->faker->randomNumber(1,30),
            'valor_unitario'=>$this->faker->numberBetween(1,300),
            'valor_total'=>$this->faker->numberBetween(12000,90000),
           'quant_total'=>$this->faker->numberBetween(120,10000),
           'id_fornecedor'=>$this->faker->numberBetween(1,10),
           'id_processo'=>$this->faker->numberBetween(1,10),

        ];
        
    }


}
