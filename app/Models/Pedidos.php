<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UnidadesController;
use App\Models\Produto;
use App\Models\Unidades;
use App\Models\OrdemFornecimento;
use OwenIt\Auditing\Contracts\Auditable;

class Pedidos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table ='pedidos';

    protected $fillable = [ 'quantidade',

    'codigo_pedido',

    'id_unidades',

    'id_produtos'];

    public function Produto(){
        return $this->belongsTo(produto::class,'id_produtos','id')->withDefault([
            'nome' => 'Produto excluído']);
    }
    public function Unidades(){
        return $this->belongsTo(unidades::class,'id_unidades','id')->withDefault([
            'nome' => 'Unidade excluída']);
    }

    
    
}
