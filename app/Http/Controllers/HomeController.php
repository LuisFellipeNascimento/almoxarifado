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

        $Processo = Processo::orderBy('id')  
        
        ->when($request->nome,function($query) use ($request){
            $query->where('numero','like','%'.$request->nome.'%');  
        })
        
        ->when($request->item,function($query) use ($request){
            $query->where('item','like','%'.$request->item.'%');  
        })
        
        ->when($request->descricao,function($query) use ($request){
            $query->where('descricao','like','%'.$request->descricao.'%');  
        })

        ->when($request->id_fornecedor,function($query) use ($request){
            $query->where('id_fornecedor','like','%'.$request->id_fornecedor.'%');  
        })
        ->orderByDesc('created_at')
        ->Paginate(5)
        ->withQueryString();
        $NumeroItem = Processo::where('numero','like','%'.$request->nome.'%')->count('numero');
        $valorempenhado = Processo::where('numero','like','%'.$request->nome.'%')->sum('valor');
        $valorquantidade = Processo::where('numero','like','%'.$request->nome.'%')->sum('quantidade');
        $nome =$request->nome;
        $item=$request->item;
        $descricao=$request->descricao;
        $id_fornecedor=$request->id_fornecedor;
        return view ('processo.index',compact('Processo','Fornecedores','nome','item','descricao','valorempenhado','valorquantidade','id_fornecedor','NumeroItem'));
       
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
                    
                ]  ,
                [ 
                    'inputs.*.numero'=>'É preciso digitar o número do processo',
                    'inputs.*.descricao'=>'É preciso digitar o item do processo',
                    'inputs.*.valor'=>'O digite o valor do produto', 
                    'inputs.*.item'=>'É preciso digitar o número do item',
                    'inputs.*.quantidade'=>'É preciso digitar a quantidade deste item',
                    'inputs.*.id_fornecedor'=>'É preciso escolher um fornecedor',
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
