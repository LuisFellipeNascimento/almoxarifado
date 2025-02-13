<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\ToModel;



class ProdutoExport implements ToModel
{
  
    public function model(array $row)
    {
        return new Produto([
           'nome_produto'=>$row[0],
           'codigobarras'=>$row[1],
           'valor_saida'   => $row[2],
           'quant_total'   => $row[3],
           'local'   => $row[4] ?? 'Almoxarifado',
           'estoque_min'=>$row[5] ?? '100',
           'estoque_ideal'=>$row[6] ?? '3000',
         
        ]);
    }
}