<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use \App\Models\Fornecedores;
Use \App\Models\Processo;
Use \App\Models\Produto;
use \App\Models\OrdemFornecimento;
use \App\Models\Unidades;
use \App\Models\Categorias;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\Fornecedores::factory(50)->create();
        //\App\Models\Processo::factory(50)->create();        
        //\App\Models\Produto::factory(2)->create();
        \App\Models\Unidades::factory(72)->create();
        //\App\Models\OrdemFornecimento::factory(10)->create();
        \App\Models\User::factory()->create([ 'name' => 'Luis Fellipe', 'email' => 'luisfellipe_rj@hotmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Fátima', 'email' => 'fatima@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Claudia', 'email' => 'claudia@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Welington Rodrigues', 'email' => 'welingtonrodrigues@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Wellington Pimenta', 'email' => 'wellingtonpimenta@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Felipe Guerato', 'email' => 'guerato@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Jessica Jóia', 'email' => 'jessica@gmail.com', 'password' => Hash::make('12345678'), ]);
        \App\Models\User::factory()->create([ 'name' => 'Fernando', 'email' => 'fernando@gmail.com', 'password' => Hash::make('12345678'), ]);
        //criado automaticamento
        //\App\Models\Categorias::factory(15)->create();        
        // Criando categorias automaticamente $categories
        $categories = [ 'Artes', 'Cadernos e Agendas', 'Cuidados Pessoais','Esportivo', 'Eletrônicos', 'Elétrica', 'Embalagens', 'Envelopes', 'Escrita', 'Escritório', 'Festas', 'Informática', 'Limpeza', 'Móveis', 'Organização', 'Papéis','Higiêne' ]; 
         foreach ($categories as $category) 
         \App\Models\Categorias::factory()->create(['nome_categoria' => $category]);          
       
                                                      
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
