<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\OrdemFornecimentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\UnidadesController;
use App\Exports\OrdemExport;
use App\Exports\GerenciarCiExport;
use Maatwebsite\Excel\Facades\Excel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
   ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
   ->name('profile');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
->middleware(['auth'],['verified'])
->name('home');

Route::get('processo.index', [App\Http\Controllers\HomeController::class,'index'])
->middleware(['auth'],['verified'])
->name('processo.index');

Route::get('processo.create', [App\Http\Controllers\HomeController::class, 'create'])
->middleware(['auth'],['verified'])
->name('processo.create');

Route::post('processo.store', [App\Http\Controllers\HomeController::class, 'store'])
->middleware(['auth'],['verified'])
->name('processo.store');

Route::get('processo.show/{id}', [App\Http\Controllers\HomeController::class, 'show'])
->middleware(['auth'],['verified'])
->name('processo.show');

Route::get('processo.edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])
->middleware(['auth'],['verified'])
->name('processo.edit');

Route::put('processo.update/{id}', [App\Http\Controllers\HomeController::class, 'update'])
->middleware(['auth'],['verified'])
->name('processo.update');

Route::delete('processo.destroy/{id}', [App\Http\Controllers\HomeController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('processo.destroy');

Route::get('/fornecedor.create', [App\Http\Controllers\FornecedorController::class,'create'])
->middleware(['auth'],['verified'])
->name('fornecedor.create');

Route::get('/lista-fornecedor', [App\Http\Controllers\FornecedorController::class,'index'])
->middleware(['auth'],['verified'])
->name('lista-fornecedor');

Route::post('store', [App\Http\Controllers\FornecedorController::class, 'store'])
->middleware(['auth'],['verified'])
->name('store');

Route::get('fornecedor.show/{id}', [App\Http\Controllers\FornecedorController::class, 'show'])
->middleware(['auth'],['verified'])
->name('fornecedor.show');

Route::get('fornecedor.edit/{id}', [App\Http\Controllers\FornecedorController::class, 'edit'])
->middleware(['auth'],['verified'])
->name('fornecedor.edit');

Route::put('fornecedor.update/{id}', [App\Http\Controllers\FornecedorController::class, 'update'])
->middleware(['auth'],['verified'])
->name('fornecedor.update');

Route::delete('fornecedor.destroy/{id}', [App\Http\Controllers\FornecedorController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('fornecedor.destroy');

Route::get('ordem.index', [App\Http\Controllers\OrdemFornecimentoController::class,'index'])
->middleware(['auth'],['verified'])
->name('ordem.index');

Route::get('ordem.create', [App\Http\Controllers\OrdemFornecimentoController::class,'create'])
->middleware(['auth'],['verified'])
->name('ordem.create');

Route::post('ordem.store', [App\Http\Controllers\OrdemFornecimentoController::class,'store'])
->middleware(['auth'],['verified'])
->name('ordem.store');

Route::get('ordem.show/{id}', [App\Http\Controllers\OrdemFornecimentoController::class, 'show'])
->middleware(['auth'],['verified'])
->name('ordem.show');

Route::put('ordem.update/{id}', [App\Http\Controllers\OrdemFornecimentoController::class, 'update'])
->middleware(['auth'],['verified'])
->name('ordem.update');

Route::get('ordem.edit/{id}', [App\Http\Controllers\OrdemFornecimentoController::class,'edit'])
->middleware(['auth'],['verified'])
->name('ordem.edit');

Route::delete('ordem.destroy/{id}', [App\Http\Controllers\OrdemFornecimentoController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('ordem.destroy');

Route::get('pedidos.export', [PedidosController::class, 'export'])
->name('pedidos.export');

Route::get('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class,'destroy']);

Route::get('produto.index', [App\Http\Controllers\ProdutoController::class,'index'])
->middleware(['auth'],['verified'])
->name('produto.index');

Route::get('produto.create', [App\Http\Controllers\ProdutoController::class,'create'])
->middleware(['auth'],['verified'])
->name('produto.create');

Route::post('produto.store', [App\Http\Controllers\ProdutoController::class,'store'])
->middleware(['auth'],['verified'])
->name('produto.store');

Route::get('produto.show/{id}', [App\Http\Controllers\ProdutoController::class, 'show'])
->middleware(['auth'],['verified'])
->name('produto.show');

Route::put('produto.update/{id}', [App\Http\Controllers\ProdutoController::class, 'update'])
->middleware(['auth'],['verified'])
->name('produto.update');

Route::get('produto.edit/{id}', [App\Http\Controllers\ProdutoController::class,'edit'])
->middleware(['auth'],['verified'])
->name('produto.edit');

Route::delete('produto.destroy/{id}', [App\Http\Controllers\ProdutoController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('produto.destroy');

Route::post('produto.import', [App\Http\Controllers\ProdutoController::class,'import'])
->middleware(['auth'],['verified'])
->name('produto.import');

Route::get('unidades.index', [App\Http\Controllers\UnidadesController::class,'index'])
->middleware(['auth'],['verified'])
->name('unidades.index');

Route::get('unidades.create', [App\Http\Controllers\unidadesController::class,'create'])
->middleware(['auth'],['verified'])
->name('unidades.create');

Route::post('unidades.store', [App\Http\Controllers\unidadesController::class,'store'])
->middleware(['auth'],['verified'])
->name('unidades.store');

Route::get('unidades.show/{id}', [App\Http\Controllers\unidadesController::class, 'show'])
->middleware(['auth'],['verified'])
->name('unidades.show');

Route::put('unidades.update/{id}', [App\Http\Controllers\unidadesController::class, 'update'])
->middleware(['auth'],['verified'])
->name('unidades.update');

Route::get('unidades.edit/{id}', [App\Http\Controllers\unidadesController::class,'edit'])
->middleware(['auth'],['verified'])
->name('unidades.edit');

Route::delete('unidades.destroy/{id}', [App\Http\Controllers\unidadesController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('unidades.destroy');

Route::get('unidades.export-users', [App\Http\Controllers\unidadesController::class,'export'])
->middleware(['auth'],['verified'])
->name('unidades.export');

Route::get('pedidos.index', [App\Http\Controllers\PedidosController::class,'index'])
->middleware(['auth'],['verified'])
->name('pedidos.index');

Route::get('pedidos.create', [App\Http\Controllers\PedidosController::class,'create'])
->middleware(['auth'],['verified'])
->name('pedidos.create');

Route::get('pedidos.criar', [App\Http\Controllers\PedidosController::class,'criar'])
->middleware(['auth'],['verified'])
->name('pedidos.criar');

Route::post('pedidos.store', [App\Http\Controllers\PedidosController::class,'store'])
->middleware(['auth'],['verified'])
->name('pedidos.store');

Route::get('pedidos.show', [App\Http\Controllers\PedidosController::class, 'export'])
->middleware(['auth'],['verified'])
->name('pedidos.show');

Route::get('pedidos.dupla', [App\Http\Controllers\PedidosController::class, 'dupla'])
->middleware(['auth'],['verified'])
->name('pedidos.dupla');

Route::get('pedidos.inventario', [App\Http\Controllers\PedidosController::class, 'exportar_saldo'])
->middleware(['auth'],['verified'])
->name('pedidos.inventario');

Route::get('pedidos.relatorio_saida', [App\Http\Controllers\PedidosController::class, 'relatorio_saida'])
->middleware(['auth'],['verified'])
->name('pedidos.relatorio_saida');

Route::get('pedidos.saldo_excel', [App\Http\Controllers\PedidosController::class, 'exportar_excel'])
->middleware(['auth'],['verified'])
->name('pedidos.saldo_excel');

Route::put('pedidos.update/{id}', [App\Http\Controllers\PedidosController::class, 'update'])
->middleware(['auth'],['verified'])
->name('pedidos.update');

Route::get('pedidos.edit/{id}', [App\Http\Controllers\PedidosController::class,'edit'])
->middleware(['auth'],['verified'])
->name('pedidos.edit');

Route::delete('pedidos.destroy/{id}', [App\Http\Controllers\PedidosController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('pedidos.destroy');

Route::get('pedidos.saldo', [App\Http\Controllers\PedidosController::class,'saldo'])
->middleware(['auth'],['verified'])
->name('pedidos.saldo');

Route::get('pedidos.saida_produto', [App\Http\Controllers\PedidosController::class,'saida_produto'])
->middleware(['auth'],['verified'])
->name('pedidos.saida_produto');

Route::get('pedidos.atividades', [App\Http\Controllers\PedidosController::class,'atividades'])
->middleware(['auth'],['verified'])
->name('pedidos.atividades');

Route::get('categorias.index', [App\Http\Controllers\CategoriasController::class,'index'])
->middleware(['auth'],['verified'])
->name('categorias.index');

Route::get('categorias.create', [App\Http\Controllers\CategoriasController::class,'create'])
->middleware(['auth'],['verified'])
->name('categorias.create');

Route::post('categorias.store', [App\Http\Controllers\CategoriasController::class,'store'])
->middleware(['auth'],['verified'])
->name('categorias.store');

Route::get('categorias.show/{id}', [App\Http\Controllers\CategoriasController::class, 'show'])
->middleware(['auth'],['verified'])
->name('categorias.show');

Route::put('categorias.update/{id}', [App\Http\Controllers\CategoriasController::class, 'update'])
->middleware(['auth'],['verified'])
->name('categorias.update');

Route::get('categorias.edit/{id}', [App\Http\Controllers\CategoriasController::class,'edit'])
->middleware(['auth'],['verified'])
->name('categorias.edit');

Route::delete('categorias.destroy/{id}', [App\Http\Controllers\CategoriasController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('categorias.destroy');

Route::get('categorias.export', [App\Http\Controllers\CategoriasController::class,'export'])
->middleware(['auth'],['verified'])
->name('categorias.export');

Route::get('gerenciarci.index', [App\Http\Controllers\GerenciaCiController::class,'index'])
->middleware(['auth'],['verified'])
->name('gerenciarci.index');

Route::get('gerenciarci.create', [App\Http\Controllers\GerenciaCiController::class,'create'])
->middleware(['auth'],['verified'])
->name('gerenciarci.create');

Route::post('gerenciarci.store', [App\Http\Controllers\GerenciaCiController::class,'store'])
->middleware(['auth'],['verified'])
->name('gerenciarci.store');

Route::get('gerenciarci.edit/{id}', [App\Http\Controllers\GerenciaCiController::class,'edit'])
->middleware(['auth'],['verified'])
->name('gerenciarci.edit');

Route::put('gerenciarci.update/{id}', [App\Http\Controllers\GerenciaCiController::class, 'update'])
->middleware(['auth'],['verified'])
->name('gerenciarci.update');

Route::delete('gerenciarci.destroy/{id}', [App\Http\Controllers\GerenciaCiController::class,'destroy'])
->middleware(['auth'],['verified'])
->name('gerenciarci.destroy');

Route::get('gerenciarci.show', function (Illuminate\Http\Request $request) {
    $filters = $request->all(); // Captura os filtros do formulário
    return Excel::download(new GerenciarCiExport($filters), 'gerenciarci.xlsx');
})->name('gerenciarci.show');

require __DIR__.'/auth.php';