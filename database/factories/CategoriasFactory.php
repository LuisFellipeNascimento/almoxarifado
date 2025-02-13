<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Processo>
 */
class CategoriasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        return [
       'nome_categoria'=>$this->faker->randomElement(array(
        
        'Artes',       
        'Cadernos e Agendas',
        'Cuidados Pessoais',
        'Eletrônicos',
        'Elétrica',
        'Embalagens',
        'Envelopes',        
        'Escrita',
        'Escritório',
        'Festas',
        'Informática',       
        'Limpeza',     
        'Móveis',       
        'Organização',        
        'Papéis',
       
       
                                                   
                                                        
                                                            
   )),
            
     ];
    }
}