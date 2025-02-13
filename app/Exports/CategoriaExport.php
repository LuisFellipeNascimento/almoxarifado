<?php

namespace App\Exports;

use App\Models\Categorias;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoriaExport implements FromView
{
    public function view(): View
    {
        return view('categorias.planilha', [
            'categorias' => \App\Models\Categorias::all()
        ]);
    }
}