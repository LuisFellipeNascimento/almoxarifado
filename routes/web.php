<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\OrdemFornecimentoController;
use App\Http\Controllers\HomeController;



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

Route::get('/criar-fornecedor', [App\Http\Controllers\FornecedorController::class,'create'])
->middleware(['auth'],['verified'])
->name('criar-fornecedor');

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

Route::get('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class,'destroy']);




require __DIR__.'/auth.php';