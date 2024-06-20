<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Processo;
use App\Models\Fornecedores;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    public function index(Request $request)
    {   $Fornecedores = Fornecedores::all();

        $Processo = Processo::orderBy('numero','asc')->orderBy('numero_of','asc')
        
        ->when($request->nome,function($query) use ($request){
            $query->where('numero','like','%'.$request->nome.'%');  
        })
        
        ->when($request->item,function($query) use ($request){
            $query->where('item','like',$request->item);  
        })
        
        ->when($request->descricao,function($query) use ($request){
            $query->where('descricao','like','%'.$request->descricao);  
        })

        ->when($request->id_fornecedor,function($query) use ($request){
            $query->where('id_fornecedor','like','%'.$request->id_fornecedor.'%');  
        })
        ->when($request->numero_of,function($query) use ($request){
            $query->where('numero_of','like','%'.$request->numero_of.'%');  
        })
        ->orderBy('item')
       
        ->Paginate(10)
        ->withQueryString();
        $NumeroItem = Processo::where('numero','like','%'.$request->nome.'%')->distinct()->count('item');
        $valorempenhado = Processo::where('numero','like','%'.$request->nome.'%')->where('id_fornecedor','like','%'.$request->id_fornecedor.'%')->sum('valor');
        $valorquantidade = Processo::where('numero','like','%'.$request->nome.'%')->sum('quantidade');
        $total_ordem = Processo::where('numero_of','like','%'.$request->numero_of.'%')->where('id_fornecedor','like','%'.$request->id_fornecedor.'%')->sum('valor');
        $total_processo = Processo::where('numero','like','%'.$request->nome.'%')->sum('valor');
        $quantidade_total_item_nas_ordens = Processo::where('item','=',$request->item)->sum('quantidade');
       
        $nome =$request->nome;
        $item=$request->item;
        $descricao=$request->descricao;
        $id_fornecedor=$request->id_fornecedor;
        $numero_of=$request->numero_of;
       
        return view ('processo.index',compact('quantidade_total_item_nas_ordens','Processo','Fornecedores','nome','item','descricao','valorempenhado','valorquantidade','id_fornecedor','NumeroItem','numero_of','total_ordem','total_processo'));
       
    }

    public function create()
    {
        $Processo = Processo::all();

        $Fornecedores = Fornecedores::all();  
        
        return view ('processo.create', compact('Processo','Fornecedores'));
    }

    public function store(Request $request)
    {
           
        $request->validate([ 
                    'inputs.*.numero'=>'required',
                    'inputs.*.descricao'=>'required',           
                    'inputs.*.valor'=>'required',
                    'inputs.*.item'=>'required',
                    'inputs.*.quantidade'=>'required',
                    'inputs.*.id_fornecedor'=>'required',
                    'inputs.*.numero_of'=>'required',
                ]  ,
                [ 
                    'inputs.*.numero'=>'É preciso digitar o número do processo',
                    'inputs.*.descricao'=>'É preciso digitar o item do processo',
                    'inputs.*.valor'=>'O digite o valor do produto', 
                    'inputs.*.item'=>'É preciso digitar o número do item',
                    'inputs.*.quantidade'=>'É preciso digitar a quantidade deste item',
                    'inputs.*.id_fornecedor'=>'É preciso escolher um fornecedor',
                    'inputs.*.numero_of'=>'É preciso digitar o número da of',
                ]            
            );
         
                
        foreach($request->inputs as $key=>$value){
                Processo::create($value); }
       
       

         return redirect()->route('processo.index')->with('success','O processo foi cadastrado com sucesso!');

     
    }
    public function show(string $id)
    {    
        $Processo =  Processo::findOrFail($id);
        return view ('processo.show',compact('Processo'));
    }

    public function edit(string $id)
    {
        $Fornecedores = Fornecedores::all();
        $Processo = Processo::findOrFail($id);
        return view ('processo.edit',compact('Processo','Fornecedores'));
    }
    
    public function update(Request $request,string $id)
    {
        $Processo = Processo::findOrFail($id);   
        
      $campos = $request->validate([ 
    'numero'=>['required'],
    'numero_of'=>'required',
    'descricao'=>'required',
    'valor'=>'required',
    'id_fornecedor'=>'required',
    'item'=>'required',
    'quantidade'=>'required',
     ]);
    

    
         
    
 
   
      $Processo->update($campos);
     
                        
        return redirect()->route('processo.index')->with('success','O processo foi editado com sucesso!');
    }

    public function destroy(Request $request,string $id)
    {
        $OrdemFornecimento = Processo::Find($id);
        $OrdemFornecimento->delete($id);
        return redirect()->back()->with('success','O processo foi apagado com sucesso!');
       
    }

}
