<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;
    protected $table ='fornecedores';

    protected $fillable = [ 'nome_fantasia',	
    'razao_social',
    'nome_representante',
    'inscricao_estadual',
        'telefone',
            'telefone2',
            'endereco',
                    'email',
                        'cnpj',
                        'observacao'];
                        public function Fornecedores(){
                            return $this->hasMany(Fornecedores::class,'id_fornecedor','id');
                        }
                       
}