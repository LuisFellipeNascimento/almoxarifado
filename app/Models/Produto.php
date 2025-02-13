<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PedidosController;
use OwenIt\Auditing\Contracts\Auditable;

class Produto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table ='produtos';

    protected $fillable = [ 
        'nome_produto',	
        'local',
        'vencimento',
        'estoque_min',
        'estoque_ideal',           
        'valor_saida',          
        'foto',
        'observacao',           
        'id_categoria',
        'quant_total',            
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

    public function Produto(){
        return $this->belongsTo(produto::class,'id_produtos','id')->withDefault([
            'nome_produto' => 'Produto excluído']);
    }

    public function Categorias(){
         return $this->belongsTo(Categorias::class,'id_categoria','id')->withDefault([
            'nome_categoria' => 'A Categoria foi excluída']);
         }


   public function OrdemFornecimentos()
                  {
                return $this->hasMany(OrdemFornecimento::class,'id_produtos');
            }
   
            public function pedidos(){
                return $this->hasMany(pedidos::class,'id_produtos');
                    }

            public function getSaldoAtualAttribute()
            {   $entrada_inicial = $this->Produto()->sum('quant_total'); 
                $entradas = $this->ordemFornecimentos()->sum('quant_total');
                $saidas = $this->pedidos()->sum('quantidade');
                return $this->quant_total + (($entradas + $entrada_inicial)  - $saidas);
            }
}
	
