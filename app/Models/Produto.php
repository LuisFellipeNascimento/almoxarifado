<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PedidosController;

class Produto extends Model
{
    use HasFactory;

    protected $table ='produtos';

    protected $fillable = [ 
        'nome',	
        'local',
        'vencimento',
        'estoque_min',
        'estoque_ideal',           
        'valor_saida',          
        'foto',
        'observacao',           
        'id_categoria',
        'quant_total',
        'valor_saida',     
        'codigobarras',    
        
      ];


    public function Fornecedores(){
        return $this->belongsTo(Fornecedores::class,'id_fornecedor','id')->withDefault([
            'nome_fantasia' => 'Fornecedor excluído']);
    }
    public function Processo(){
        return $this->belongsTo(Processo::class,'id_processo','id')->withDefault([
            'numero' => 'Processo excluído']);
    }

   
    public function Produtos(){
        return $this->hasMany(Produto::class)->withDefault();
    }

   
}
	
