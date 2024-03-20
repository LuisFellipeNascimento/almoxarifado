<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedores;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produto =  produto::orderBy('id','desc')       
            ->when($request->nome, function ($query) use ($request) {
                $query->where('nome','like','%'. $request->nome.'%');
            })
            ->when($request->local, function ($query) use ($request) {
                $query->where('local','like','%'.$request->local.'%');
            
            })
            ->when($request->vencimento, function ($query) use ($request) {
                $query->whereYear('vencimento','like','%'. $request->vencimento.'%');
            })
      
        
       ->orderByDesc('created_at')
       ->Paginate(10)
       ->withQueryString();
        //recuperar valor selecionado
        $nome = $request->nome;
        $local = $request->local;
        $vencimento = $request->vencimento;
        return view ('produto.index',compact('produto','local','nome','vencimento'));
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //para compor os select de Fornecedores e Processos
         $Fornecedores = Fornecedores::all();
         $Processos =Processo::all();
         
         return view ('produto.create',compact('Processos','Fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([ 
            'nome'=>['required'],
            'vencimento'=>'nullable',	
            'local'=>['required'],
            'estoque_min'=>['required'],
            'estoque_ideal'=>['required'],           
            'valor_saida'=>['required'],          
            'foto'=> 'nullable|mimes:jpeg,jpg,png',
            'observacao'=>['nullable'],           
            'id_categoria'=>['nullable'],
            'codigobarras'=>['nullable'],
            'quant_total'=>['required']
            ]) ;

            if($request->has('foto')){
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $path = 'uploads/foto_produtos/';
                $file->move($path,$filename);
            }

 
                
        Produto::create([
        'nome'=>$request->nome,	
        'local'=>$request->local,
        'vencimento'=>$request->vencimento,
        'estoque_min'=>$request->estoque_min,
        'estoque_ideal'=>$request->estoque_ideal,           
        'valor_saida'=>$request->valor_saida,          
        'foto'=>$path.$filename,
        'observacao'=>$request->observacao,           
        'id_categoria'=>$request->id_categoria,
        'quant_total'=>$request->quant_total,
        'codigobarras'=>$request->codigobarras,
          ]);
       
         return redirect()->route('produto.index')->with('success','O produto foi cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $produto = produto::findOrFail($id);
        return view ('produto.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {  
        $request->validate([ 
            'nome'=>['required'],	
            'local'=>['required'],
            'vencimento'=>['nullable'],
            'estoque_min'=>['required'],
            'estoque_ideal'=>['required'],           
            'valor_saida'=>['required'],          
            'foto'=> 'nullable|mimes:jpeg,jpg,png',
            'observacao'=>['nullable'],           
            'id_categoria'=>['nullable'],
            'quant_total'=>['required'],
            'codigobarras'=>['nullable'],
            ]) ;
            
            $produto = Produto::findOrFail($id);

            if($request->has('foto')){
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $path = 'uploads/foto_produtos/';
                $file->move($path, $filename);

             if(File::exists($produto->foto)){
                File::delete($produto->foto);
             }   
            }

            
                
        $produto->update([
        'nome'=>$request->nome,	
        'local'=>$request->local,
        'vencimento'=>$request->vencimento,
        'estoque_min'=>$request->estoque_min,
        'estoque_ideal'=>$request->estoque_ideal,           
        'valor_saida'=>$request->valor_saida,          
        'foto'=>$path.$filename,
        'observacao'=>$request->observacao,           
        'id_categoria'=>$request->id_categoria,
        'quant_total'=>$request->quant_total,
        'codigobarras'=>$request->codigobarras,
          ]);
       
         return redirect()->route('produto.index')->with('success','O produto foi editado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
