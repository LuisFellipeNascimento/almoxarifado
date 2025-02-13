<?php

namespace App\Models;

use App\Models\Fornecedores;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdemFornecimento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;   
    protected $table ='ordem_fornecimentos';

    protected $fillable = [ 'numero_ordem',

    'emissao',

    'id_produtos',

    'nota_fiscal',

    'empenho',

    'item',

    'valor_unitario',

    'valor_total',

    'quant_total',

    'id_fornecedor',

    'data_entrega',

    'id_processo'];

    protected $dates = [
        'emissao',
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
        return $this->belongsTo(produto::class,'id_produtos')->withDefault([
            'nome_produto' => 'Produto excluído']);
    }

 }
