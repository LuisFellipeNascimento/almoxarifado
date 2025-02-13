<?php

namespace App\Http\Controllers;

use App\Models\Unidades;
use Illuminate\Http\Request;
use App\Exports\OrdemExport;
use Maatwebsite\Excel\Facades\Excel;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
        $unidades =  Unidades::when($request->has('nome_unidade','codigo'), function ($whenQuery) use ($request){
            if($request->nome_unidade)
            $whenQuery ->where('nome_unidade','like','%'.$request->nome_unidade.'%');
            if($request->codigo)
            $whenQuery->where('id','like','%'.$request->codigo.'%');
        })
       ->orderByDesc('created_at')
       ->Paginate(12);
       $oi = "Olá";
       $nome_unidade = $request->nome_unidade;
       $codigo = $request->codigo;
       
       return view ('unidades.index',compact('unidades','oi','nome_unidade','codigo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([ 
            'nome_unidade'=>['required','unique:unidades'],            
            ]) ;

           
                
        unidades::create([
        'nome_unidade'=>$request->nome_unidade,	        
          ]);
       
         return redirect()->route('unidades.index')->with('success','A unidade foi cadastrada com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unidades = unidades::findOrFail($id);
        return view ('unidades.show',compact('unidades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $unidades = unidades::findOrFail($id);
        return view ('unidades.edit',compact('unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $unidades = unidades::findOrFail($id);   
        
    $request->validate([ 
    'nome_unidade'=>['required','unique:unidades'],	
     ]);
                        
     $unidades->update($request->all());
                        
        return redirect()->route('unidades.index')->with('success','A unidade foi editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $unidades = unidades::Find($id);
        $unidades->delete($id);
        return redirect()->route('unidades.index')->with('success','A unidade foi apagada com sucesso!');
    }

    public function export()
    {
        return Excel::download(new OrdemExport, 'Nome das unidades.ods', \Maatwebsite\Excel\Excel::ODS);
    }
}

