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
    {
        $Processo = Processo::when($request->has('nome','valor','descricao'),function($whenQuery) use ($request){
         if($request->nome)
        $whenQuery->where('numero','like','%'.$request->nome.'%');
        if($request->valor)
        $whenQuery->where('valor','like','%'.$request->valor.'%');
        if($request->descricao)
        $whenQuery->where('descricao','like','%'.$request->descricao.'%');

        }) 
        ->orderByDesc('created_at')
        ->Paginate(5)
        ->withQueryString();

        $valorempenhado = Processo::where('numero','like','%'.$request->nome.'%')->sum('valor');

        $nome =$request->nome;
        $valor=$request->valor;
        $descricao=$request->descricao;

        return view ('processo.index',compact('Processo','nome','valor','descricao','valorempenhado'));
       
    }

    public function create()
    {
        $Processo = Processo::all();
        
        return view ('processo.create', compact('Processo'));
    }

    public function store(Request $request)
    {
           
        $request->validate([ 
                    'inputs.*.numero'=>'required',
                    'inputs.*.descricao'=>'required',           
                    'inputs.*.valor'=>'required',
                    
                ]  ,
                [ 
                    'inputs.*.numero'=>'É preciso digitar o número do processo',
                    'inputs.*.descricao'=>'É preciso digitar o item do processo',
                    'inputs.*.valor'=>'O digite o valor do produto',  ]            
            );
         
                
        foreach($request->inputs as $key=>$value){
                Processo::create($value); }
       
        $campos = $request->validate([ 
            'numero'=>['required','unique:processo'],
            'descricao'=>['required'],
            'valor'=>['required']
                ]);

                $campos = $request->except('valor');

                //removendo pontos e traço e criando a chave para validação.
                $campos['valor'] = str_replace(',','.',str_replace('.','', $request->input('valor')));
                
                
              
                //$numero = "1.234,56";
               // $numero = str_replace(',','.',str_replace('.','',$numero));
               // echo $numero;
                // 1234.56
                
        
                Processo::create($campos);

         return redirect()->route('processo.index')->with('success','O processo foi cadastrado com sucesso!');

     
    }
    public function show(string $id)
    {
        $Processo =  Processo::findOrFail($id);
        return view ('processo.show',compact('Processo'));
    }

    public function edit(string $id)
    {
        $Processo = Processo::findOrFail($id);
        return view ('processo.edit',compact('Processo'));
    }
    
    public function update(Request $request,string $id)
    {
        $Processo = Processo::findOrFail($id);   
        
      $campos = $request->validate([ 
    'numero'=>['required'],
    'descricao'=>'required',
    'valor'=>'required',
     ]);
    

    //removendo pontos e traço e criando a chave para validação.
    $campos['valor'] = str_replace(',','.',str_replace('.','', $request->input('valor')));
    
         
    
 
   
      $Processo->update($campos);
     
                        
        return redirect()->route('processo.index')->with('success','O processo foi editado com sucesso!');
    }

    public function destroy(Request $request,string $id)
    { 
        $Processo = Processo::Find($id);
        $Processo->delete($id);
        return redirect()->route('processo.index')->with('success','O processo foi apagado com sucesso!');
    }

}
