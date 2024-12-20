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
                        'Creche Municipal Maria Rosa'
                        ,
                          'Creche Municipal Edson Cruz Amado'
                          ,
                            'Creche Municipal Euclydes José Borges'
                            ,
                              'Creche Municipal Florentino Elias Fula'
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
                                                    'Creche Municipal Danielle Batista'                                                     
                                                    ,
                                                    'E.M.E.I Hypólito Vieira de Carvalho '
                                                    ,
                                                    'E.M.E.I Pref. Isoldackson C. De Brito'
                                                    ,
                                                    'E.M.E.I. Monteiro Lobato'
                                                    ,
                                                      'E.E.M Camilo Cuquejo'
                                                      ,
                                                        'E.E.M Carmem Menezes Direito'
                                                        ,
                                                          'E.E.M Chaperó'
                                                          ,
                                                            'E.E.M Taciano Basilio'
                                                            ,
                                                            'E.E.M Dr Jorge Abrahão'
                                                            ,
                                                            'E.E.M Valinha'
                                                            ,
                                                            'E.M Alexandre Ignácio'
                                                            ,
                                                              'Escola Municipal Coronel Alziro Santiago'
                                                            ,
                                                              'Escola Municipal Antonio Tupinamba'
                                                            ,
                                                              'Escola Municipal Amauri Ferreira'
                                                            ,  
                                                              'E.M Das Acácias'
                                                            ,
                                                              'E.M Eider Ribeiro Dantas'
                                                            ,
                                                            'E.M Elmira Figueira'
                                                            ,
                                                            'E.M Elmo Baptista Coelho'
                                                            ,
                                                              'E.M Argentina Coutinho'
                                                             ,
                                                              'E.M João Vicente Soares'
                                                              ,
                                                              'E.M Jorge Flores Da Silva'
                                                              ,
                                                              'E.M Guilhermina De Souza Freire'
                                                              ,
                                                              'E.M Oscar José De Souza'
                                                               ,
                                                               'E.M Padre Rafael Scarfó'
                                                               ,
                                                               'E.M Pref. Abeilard Goulart De Souza',

                                                               'E.M Pref. Otoni Rocha'
                                                               ,
                                                               'E.M Pref.  Wilsom Pedro Francisco'
                                                               ,
                                                               'E.M Prof. Severina Dos Ramos De Souza'
                                                               ,
                                                               'E.M Prof. Yolanda Rangel Pereira'
                                                               ,
                                                               'E.M Renato Gonçalves Martins'
                                                               ,
                                                               'E.M São Sebastião'
                                                               ,
                                                               'E.M Severino Salustiano De Farias'
                                                               ,
                                                               'E.M Sylvia Souza Siquinelli'
                                                               ,
                                                               'E.M Tereza de Araújo Sagário'                                                               
                                                               ,
                                                               'E.M Vereador Américo R. Amorim'
                                                               ,
                                                               'E.M Vereador José Galliaço Prata'
                                                               ,
                                                               'E.M Vereador Taciano Fernandes Nunes'                                                              
                                                               ,
                                                              'E.M Professora Marianilde Siqueira Gonçalves'
                                                            ,
                                                              'Escola Municipal das Acacias',)),
            
                                                            ];
    }
}