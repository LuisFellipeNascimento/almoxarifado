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
        $vencimento = OrdemFornecimento::whereDate('emissao', '<=', Carbon::now()->toDateString())->get(['emissao','numero_ordem','id_fornecedor']);
        $ja_vencida = OrdemFornecimento::whereDate('emissao', '>=', Carbon::now()->toDateString())->get(['emissao','numero_ordem','id_fornecedor']);
      
       
        view()->share('vencimento',$vencimento);
        view()->share('ja_vencida',$ja_vencida);
        
    }
}
