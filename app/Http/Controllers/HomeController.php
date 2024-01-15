<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Processo;
use App\Models\Fornecedores;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $Processo = Processo::orderBy('created_at','DESC')->Paginate(5);
        return view ('processo.index',compact('Processo'));
       
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
