<?php

namespace App\Exports;

use App\Models\Unidades;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdemExport implements FromView
{
    public function view(): View
    {
        return view('unidades.planilha', [
            'unidades' => \App\Models\unidades::all()
        ]);
    }
}