<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unidades;

class GerenciaCi extends Model
{
    use HasFactory;

    protected $table ='gerencia_cis';

    protected $fillable = [ 
    'numero_ci',
    'descricao',
    'recebimento_ci',
    'atendimento_ci',
    'data_resposta',
    'status',
    'id_unidades',


     ];

     protected $dates = [
        'recebimento_ci','atendimento_ci','data_resposta',
    ];
   
    public function Unidades(){
        return $this->belongsTo(unidades::class,'id_unidades','id')->withDefault([
            'nome_unidade' => 'Unidade excluída']);
    }
}