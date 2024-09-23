<?php

namespace Database\Factories;

use App\Models\Processo;
use App\Models\Fornecedores;
use App\Models\Produto;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdemFornecimentoFactory extends Factory
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
           'emissao'=>$this->faker->dateTimeInInterval('-15 days', '+15 days'),
           'data_entrega'=>$this->faker->dateTimeInInterval('-15 days', '+15 days'),
            'empenho'=>$this->faker->numerify('###/##'),
            'item'=>$this->faker->randomNumber(1,30),
            'valor_unitario'=>$this->faker->numberBetween(1,300),
            'valor_total'=>$this->faker->numberBetween(12000,90000),
           'quant_total'=>$this->faker->numberBetween(120,10000),
           'nota_fiscal'=>$this->faker->randomElement(array('580','600','3145','4847')),
           'id_fornecedor'=>fornecedores::factory(),
           'id_processo'=>processo::factory(),
           'id_produtos'=>produto::factory(),

        ];
        
    }


}
