<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use App\Models\OrdemFornecimento;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class OrdemFornecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   $Processos =Processo::all(); 
        $Fornecedores = Fornecedores::all();       
        $ordem = OrdemFornecimento::when($request->has('id_processo'), function ($whenQuery) use ($request){
            $whenQuery ->where('id_processo','like','%'.$request->id_processo.'%');
        })
       ->orderByDesc('id_fornecedor')
       ->paginate(5);
       
       $total_produtos = $ordem->sum('valor_total');
      
       $valorempenhado = Processo::where('id',$request->id_processo)->sum('valor');
       
       $resultado = $valorempenhado - $total_produtos;

       //recuperar valor selecionado
       $id_processo = $request->id_processo;

        return view ('ordem.index',compact('ordem','Fornecedores','Processos','total_produtos','resultado','id_processo' ));
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  
        //para compor os select de Fornecedores e Processos
        $Fornecedores = Fornecedores::all();
        $Processos =Processo::all();
        
        return view ('ordem.create',compact('Processos','Fornecedores'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = $request->validate([ 
            'numero_ordem'=>['required'],	
            'emissao'=>['required'],
            'empenho'=>['required'],
            'item'=>['required'],
            'valor_unitario'=>['required'],
            'valor_total'=>['required'],          
            'quant_total'=>['required'],
            'id_fornecedor'=>['required'],
            'id_processo'=>['required']]) ;
            OrdemFornecimento::create($campos);
         
       
         return redirect()->route('ordem.index')->with('success','A ordem foi cadastrada com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Fornecedores = Fornecedores::all();
        $Processos =Processo::all();
        $OrdemFornecimento = OrdemFornecimento::findOrFail($id);
        return view ('ordem.show',compact('OrdemFornecimento','Processos','Fornecedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Fornecedores = Fornecedores::all();
        $Processo =Processo::all();
        $OrdemFornecimento = OrdemFornecimento::findOrFail($id);
        return view ('ordem.edit',compact('OrdemFornecimento','Processo','Fornecedores'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $OrdemFornecimento = OrdemFornecimento::findOrFail($id);  

        $request->validate([ 
        'numero_ordem' =>['required'],	

        'emissao' =>['required'],

        'empenho' =>['required'],

        'item' =>['required'],

        'valor_unitario' =>['required'],

        'valor_total' =>['required'],

        'quant_total' =>['required'],

        'id_fornecedor' =>[''],

        'id_processo' =>['required']]);

        $OrdemFornecimento->update($request->all());
                        
        return redirect()->route('ordem.index')->with('success','a ordem de foi editada com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdemFornecimento $ordemFornecimento)
    {
        //
    }
    
}
