<?php
namespace App\Exports;

use App\Pedidos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class SaldoExport implements FromCollection, WithHeadings,ShouldAutoSize,WithStyles
{
    protected $saidas;

    public function __construct($saidas)
    {
        $this->saidas = $saidas;
    }

    public function collection()
    {
        // Calcular o total
        $totalQuantidade = $this->saidas->sum('quant_total');
        $totalValor = $this->saidas->sum(function($saida) {
            return $saida->quant_total * $saida->valor_saida;
        });

        // Mapear os dados
        $dados = $this->saidas->map(function($saida) {
            return [
                'Nome do Material' => $saida->nome_produto,
                'Local' => $saida->local,
                'Quantidade em estoque' => $saida->quant_total,
                'Valor unitário' => $saida->valor_saida,
                'Valor Total' => $saida->quant_total * $saida->valor_saida,
                'Validade' => Carbon::parse($saida->vencimento)->format('d/m/Y'),
            ];
        });

        // Adicionar a linha de total
        $dados->push([
            'Nome do Material' => '',
            'Local' => '',
            'Quantidade em estoque' => $totalQuantidade,
            'Valor unitário' => '',
            'Valor Total' => $totalValor,
            'Validade' => '',
        ]);

        return $dados;
    }

    public function headings(): array
    {
        return [
            'Nome do Material',
            'Local de Armazenamento',
            'Quantidade em estoque',
            'Valor unitário',
            'Valor Total',
            'Validade',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            

          
        ];
    }
}