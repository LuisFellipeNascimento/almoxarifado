<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Exports\CategoriaExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias =  Categorias::when($request->has('nome_categoria','id'), function ($whenQuery) use ($request){
            if($request->nome_categoria)
            $whenQuery ->where('nome_categoria','like','%'.$request->nome_categoria.'%');
          
        })
       ->orderByDesc('created_at')
       ->Paginate(10);
       
       $nome_categoria = $request->nome_categoria;
   
       
       return view ('categorias.index',compact('categorias','nome_categoria',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'nome_categoria'=>['required','unique:categorias'],            
            ]) ;
    
           
                
        categorias::create([
        'nome_categoria'=>$request->nome_categoria,	        
          ]);
       
         return redirect()->route('categorias.index')->with('success','A Categoria foi cadastrada com sucesso!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $categorias = categorias::findOrFail($id);
        return view ('categorias.edit',compact('categorias'));
    }
    

    public function update(Request $request, String $id)
{
    $categorias = categorias::findOrFail($id);   
    
$request->validate([ 
'nome_categoria'=>['required','unique:categorias'],	
 ]);
                    
 $categorias->update($request->all());
                    
    return redirect()->route('categorias.index')->with('success','A Categoria foi editada com sucesso!');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Request $request,string $id)
{
    $categorias = categorias::Find($id);
    $categorias->delete($id);
    return redirect()->route('categorias.index')->with('success','A Categoria foi apagada com sucesso!');
}

public function export()
{
    return Excel::download(new CategoriaExport, 'Nome das categorias.ods', \Maatwebsite\Excel\Excel::ODS);
}

}