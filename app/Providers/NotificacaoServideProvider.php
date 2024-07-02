<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OrdemFornecimento;
use Carbon\Carbon;

class NotificacaoServideProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $vencimento_da_ordem = OrdemFornecimento::whereDate('emissao', '<=', Carbon::now()->toDateString())->distinct('numero_ordem')->get(['emissao','numero_ordem','id_fornecedor','id_processo']);
        $ja_vencida = OrdemFornecimento::whereDate('emissao', '>=', Carbon::now()->toDateString())->distinct('numero_ordem')->get(['emissao','numero_ordem','id_fornecedor']);
      
       
        view()->share('vencimento_da_ordem',$vencimento_da_ordem);
        view()->share('ja_vencida',$ja_vencida);
        
    }
}
