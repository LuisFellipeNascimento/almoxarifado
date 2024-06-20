<?php

namespace App\Exports;


use App\Models\OrdemFornecimento;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdemExport implements FromCollection
{
    use Exportable;

    public function collection(Request $request)
    {
        return OrdemFornecimento::where('numero','=',$request->numero_ordem)->get();
    }
}


