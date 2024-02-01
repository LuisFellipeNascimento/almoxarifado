<?php

namespace App\Models;

use App\Models\Fornecedores;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemFornecimento extends Model
{
    use HasFactory;   
    protected $table ='ordem_fornecimentos';

    protected $fillable = [ 'numero_ordem',

    'emissao',

    'empenho',

    'item',

    'valor_unitario',

    'valor_total',

    'quant_total',

    'id_fornecedor',

    'id_processo'];


    public function Fornecedores(){
        return $this->belongsTo(Fornecedores::class,'id_fornecedor','id')->withDefault([
            'nome_fantasia' => 'Fornecedor excluído']);
    }
    public function Processo(){
        return $this->belongsTo(Processo::class,'id_processo','id')->withDefault([
            'numero' => 'Processo excluído']);
    }
}
