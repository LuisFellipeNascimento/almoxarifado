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
            $ordem =  OrdemFornecimento::orderBy('id', 'desc')
            ->with('processo')
            ->when($request->id_processo, function ($query) use ($request) {
                $query->whereIn('id_processo', $request->id_processo);
            })
            ->when($request->id_fornecedor, function ($query) use ($request) {
                $query->where('id_fornecedor', $request->id_fornecedor);
            })
       ->orderByDesc('id_fornecedor')
       ->paginate(3);
       $n1=0;
       foreach ($ordem as $rs) {
       $rs->Processo->numero;
       $n1=$rs->Processo->numero;}
     
      
       $valorempenhado = Processo::where('numero','like','%'.$n1.'%')->sum('valor');
       $total_produtos = $ordem->sum('valor_total');
       
       $resultado = $valorempenhado - $total_produtos;

       //somar por fornecedor
       //$valorFornecedor =  $ordem('id_fonecedor',$request->id_fonecedor)->sum('valor_total'); 

       //recuperar valor selecionado
       $id_processo = $request->id_processo;
       $id_fornecedor = $request->id_fornecedor;

        return view ('ordem.index',compact('ordem','Fornecedores','Processos','total_produtos','resultado','id_processo','id_fornecedor'));
     
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
        //removendo pontos e traço e criando a chave para validação.
        
      

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

           
            
            $campos = $request->except('valor_unitario','valor_total');   
            $campos['valor_unitario'] = str_replace(',','.',str_replace('.','', $request->input('valor_unitario')));            
            $campos['valor_total'] = str_replace(',','.',str_replace('.','', $request->input('valor_total')));
            
                
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
         
        $campos = $request->validate([ 
        'numero_ordem' =>['required'],	

        'emissao' =>['required'],

        'empenho' =>['required'],

        'item' =>['required'],

        'valor_unitario' =>['required'],

        'valor_total' =>['required'],

        'quant_total' =>['required'],

        'id_fornecedor' =>['required'],

        'id_processo' =>['required']]);

         //removendo pontos e traço e criando a chave para validação.
        $campos = $request->except('valor_unitario','valor_total');   
        $campos['valor_unitario'] = str_replace(',','.',str_replace('.','', $request->input('valor_unitario')));            
        $campos['valor_total'] = str_replace(',','.',str_replace('.','', $request->input('valor_total')));
        

        $OrdemFornecimento->update($campos);
                        
        return redirect()->route('ordem.index')->with('success','a ordem de foi editada com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $OrdemFornecimento = OrdemFornecimento::Find($id);
        $OrdemFornecimento->delete($id);
        return redirect()->route('ordem.index')->with('success','A Ordem de Fornecimento foi apagada com sucesso!');
  
    }
    
}
