<?php

namespace App\Exports;

use App\Models\GerenciaCi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GerenciarCiExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        // Filtrar os dados com base nos filtros recebidos
        $controle_ci = GerenciaCi::query()->orderBy('atendimento_ci', 'asc');

        if (!empty($this->filters['numero_ci'])) {
            $controle_ci->where('numero_ci', 'like', '%' . $this->filters['numero_ci'] . '%');
        }

        if (!empty($this->filters['status'])) {
            $controle_ci->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['descricao'])) {
            $controle_ci->where('descricao', 'like', '%' . $this->filters['descricao'] . '%');
        }

        // Adicione outros filtros conforme necessário...

        return view('gerenciarci.show', [
            'controle_ci' => $controle_ci->get()
        ]);
    }
}