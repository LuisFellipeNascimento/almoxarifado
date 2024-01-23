<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedores>
 */
class FornecedoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
   'nome_fantasia'=>$this->faker->company,	
    'razao_social'=>$this->faker->name(),
    'nome_representante'=>$this->faker->name,
    'inscricao_estadual'=>$this->faker->cnpj(),
    'cnpj'=> $this->faker->cnpj(),
    'telefone'=>$this->faker->cellphoneNumber(),
    'telefone2'=>$this->faker->cellphoneNumber(),
    'endereco' =>$this-> faker->address,
    'email' => $this->faker->email(),    
    'observacao'=>$this->faker->text,
                    ];
       
    }
}
