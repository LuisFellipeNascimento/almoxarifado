<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use \App\Models\Fornecedores;
Use \App\Models\Processo;
use \App\Models\OrdemFornecimento;


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
        
       
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
