<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Processo;
use App\Models\Fornecedores;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $Processo = Processo::when($request->has('nome','valor'),function($whenQuery) use ($request){
        if($request->nome)
        $whenQuery->where('numero','like','%'.$request->nome.'%');
        if($request->valor)
        $whenQuery->where('valor','like','%'.$request->valor.'%');

        }) 
        ->orderByDesc('created_at')
        ->Paginate(5)
        ->withQueryString();

        $nome =$request->nome;
        $valor=$request->valor;

        return view ('processo.index',compact('Processo','nome','valor'));
       
    }

    public function create()
    {
        $Processo = Processo::all();
        
        return view ('processo.create', compact('Processo'));
    }

    public function store(Request $request)
    {
         Processo::create($request->all());
         return redirect()->route('processo.index')->with('success','O número do processo foi cadastrado com sucesso!');

     
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
        
        $request->validate([ 
    'numero'=>['required','unique:Processo'],	
    ]);
                        
                        $Processo->update($request->all());
                        
        return redirect()->route('processo.index')->with('success','O número do processo foi editado com sucesso!');
    }

    public function destroy(Request $request,string $id)
    { 
        $Processo = Processo::Find($id);
        $Processo->delete($id);
        return redirect()->route('processo.index')->with('success','O número do processo foi apagado com sucesso!');
    }

}
