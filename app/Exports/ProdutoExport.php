<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProdutoExport implements ToModel,WithHeadingRow
{
  
    public function model(array $row)
    {
        return new Produto([
           'nome'     => $row[0],
           'id'    => $row[1],
           'valor_saida'   => $row[2],
           'quant_total'   => $row[3],
           'local'   => $row[4] ?? 'Patrimônio',
           'estoque_min'=>$row[5] ?? '10',
           'estoque_ideal'=>$row[6] ?? '10',
         
        ]);
    }
}