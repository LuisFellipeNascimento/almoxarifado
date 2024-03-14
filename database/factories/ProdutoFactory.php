<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'=>$this->faker->word,
            'local'=>$this->faker->randomElement(array('Almoxarifado SMEC','Reta','Patrimônio')),
            'vencimento'=>$this->faker->dateTimeInInterval('-1 years ', '+2 years '),
            'estoque_min'=>$this->faker->randomDigitNotNull(5),
            'estoque_ideal'=>$this->faker->randomDigitNotNull(5),         
            'valor_saida'=>$this->faker->randomFloat(2),             
            'foto'=>$this->faker->imageUrl($width = 640, $height = 480),
            'observacao'=>$this->faker->sentence(45),          
            'id_categoria'=>$this->faker->numberBetween(1,7), 
            'quant_total'=>$this->faker->randomNumber(5),
            'valor_saida'=>$this->faker->randomFloat(2),    
                    
      
        ];
    }
}
