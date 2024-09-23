<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use \App\Models\Fornecedores;
Use \App\Models\Processo;
Use \App\Models\Produto;
use \App\Models\OrdemFornecimento;
use \App\Models\Unidades;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Fornecedores::factory(50)->create();
        \App\Models\Processo::factory(50)->create();        
        \App\Models\Produto::factory(100)->create();
        \App\Models\Unidades::factory(62)->create();
        \App\Models\OrdemFornecimento::factory(100)->create();
        
                                                      
      // \App\Models\unidades::factory()->create([
      //      'nome' => '',     
      //    ]);
        
       

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
