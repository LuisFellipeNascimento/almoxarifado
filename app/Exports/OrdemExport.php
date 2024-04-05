<?php

namespace App\Exports;

use App\Models\Fornecedores;
use App\Models\OrdemFornecimento;
use App\Models\Processo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class OrdemExport implements FromView
{
      public function view(): View
    {
        return view('ordem.index',[
            'ordem'=>OrdemFornecimento::all(),
            'Processos'=>Processo::all(),
            'Fornecedores'=>Fornecedores::all(),
            
        ]);
    }
}