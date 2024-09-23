<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Processo>
 */
class UnidadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        return [
       'nome'=>$this->faker->randomElement(array(
        'Centro Municipal de Atendimento Educacional Especializado - Cemaee',
        
            'CIEP 300 - Municipalizado Prefeito Vicente Cicarino'
            ,
              'CIEP 496 - Municipalizado Maestro Francisco Mignone'
              ,
                  'CIEP 497 - Municipalizado Professora Silvia Tupinamba'
                  ,
                    'Colégio Municipal Senador Teotonio Vilella'
                    ,
                      'Creche Municipal Aparecida Azedo'
                      ,
                        'CIEP 497 - Municipalizado Professora Silvia Tupinamba'
                        ,
                          'Creche Municipal Edson Cruz Amado'
                          ,
                            'Creche Municipal Euclydes José Borges'
                            ,
                              'Creche Municipal Florentino Elias'
                              ,
                                'Creche Municipal Francisco Xavier de Moura Brito'
                                ,
                                  'Creche Municipal Maria Eduviges do Rosario Silva'
                                  ,
                                    'Creche Municipal Professor Goethe Coutinho Madruga'
                                    ,
                                      'Creche Municipal Professor Joaquim Inoue'
                                      ,
                                        'Creche Municipal Professor Renato Barbosa Ladislau'
                                        ,
                                          'Creche Municipal Professora Eliane Lopes Barbosa'
                                          ,
                                            'Creche Municipal Professora Maria Cristina Padela Cabral da Silva'
                                            ,
                                              'Creche Municipal Professora Maria de Lurdes Souza Garcia'
                                              ,
                                                'Creche Municipal Professora Tania Mara Mota Menezes'
                                                ,
                                                  'Creche Municipal Rita Ferreira Feijo'
                                                  ,
                                                    'Creche Municipal Vereador José Antonio Carrasco'
                                                    ,
                                                      'E.E.M Camilo Cuquejo'
                                                      ,
                                                        'E.E.M Carmem Menezes Direito'
                                                        ,
                                                          'E.E.M Chapero'
                                                          ,
                                                            'E.E.M Taciano Basilio'
                                                            ,
                                                              'Escola Municipal Coronel Alziro Santiago'
                                                            ,
                                                              'Escola Municipal Antonio Tupinamba'
                                                            ,
                                                              'Escola Municipal Amauri Ferreira'
                                                            ,
                                                              'Escola Municipal das Acacias',)),
            
                                                            ];
    }
}
