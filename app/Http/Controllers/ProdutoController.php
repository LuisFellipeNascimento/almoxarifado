<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedores;
use App\Models\Processo;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdutoExport;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Categorias =Categorias::all();
        $produto =  produto::orderBy('id','desc')       
            ->when($request->nome, function ($query) use ($request) {
                $query->where('nome_produto','like','%'. $request->nome.'%');
            })
            ->when($request->codigobarras, function ($query) use ($request) {
                $query->where('codigobarras', $request->codigobarras);
            })
            ->when($request->local, function ($query) use ($request) {
                $query->where('local','like','%'.$request->local.'%');
            
            })
            ->when($request->vencimento, function ($query) use ($request) {
                $query->whereYear('vencimento','like','%'. $request->vencimento.'%');
            })
            ->when($request->id_categoria, function ($query) use ($request) {
                $query->where('id_categoria','like','%'. $request->id_categoria.'%');
            })
      
        
       ->orderByDesc('created_at')
       ->Paginate(10)
       ->withQueryString();
        //recuperar valor selecionado
        $nome = $request->nome;
        $codigobarras= $request->codigobarras;
        $local = $request->local;
        $vencimento = $request->vencimento;
        $id_categoria=$request->id_categoria;
        $selectedCategoryId = $request->input('id_categoria'); // Ou pegue esse valor de outra fonte, se necessário
        return view ('produto.index',compact('produto','local','nome','vencimento','Categorias','id_categoria','selectedCategoryId','codigobarras'));
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //para compor os select de Fornecedores e Processos
         $Fornecedores = Fornecedores::all();
         $Processos =Processo::all();
         $Categorias =Categorias::all();
         
         return view ('produto.create',compact('Processos','Fornecedores','Categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([ 
            'nome_produto'=>['required','unique:produtos'],
            'vencimento'=>'nullable',	
            'local'=>['required'],
            'estoque_min'=>['required'],
            'estoque_ideal'=>['required'],           
            'valor_saida'=>['required'],                     
            'foto'=> 'nullable|mimes:jpeg,jpg,png',
            'observacao'=>['nullable'],           
            'id_categoria'=>['required'],
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
            $path = NULL;
            $filename = NULL;
 
                
        Produto::create([
        'nome_produto'=>$request->nome_produto,	
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
    {   $Categorias = Categorias::all();
        $produto = produto::findOrFail($id);
        return view ('produto.edit',compact('produto','Categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {  
        $request->validate([ 
            'nome_produto'=>['required'],	
            'local'=>['required'],
            'vencimento'=>['nullable'],
            'estoque_min'=>['required'],
            'estoque_ideal'=>['required'],               
            'foto'=> 'nullable|mimes:jpeg,jpg,png',
            'observacao'=>['nullable'],           
            'id_categoria'=>['required'],
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
             
             $produto->update([
                'nome_produto'=>$request->nome_produto,	
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
             
            }
       
                
        $produto->update([
        'nome_produto'=>$request->nome_produto,	
        'local'=>$request->local,
        'vencimento'=>$request->vencimento,
        'estoque_min'=>$request->estoque_min,
        'estoque_ideal'=>$request->estoque_ideal,           
        'valor_saida'=>$request->valor_saida,         
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
    public function destroy(Produto $produto,string $id)
    {
        $produto = Produto::findOrFail($id);
        if(File::exists($produto->foto)){
            File::delete($produto->foto);
        }

        $produto->delete();

        return redirect()->back()->with('success','O produto foi apagado o com sucesso!');
    }

    public function export()
    {
        return Excel::download(new OrdemExport, 'unidades para plaqueamento.ods', \Maatwebsite\Excel\Excel::ODS);
    }

    public function import(Request $request)
    {
        
        
    Excel::import(new ProdutoExport, $request->file('excel_file'), \Maatwebsite\Excel\Excel::XLSX);
     
    return redirect()->back()->with('success', 'Dados importados com sucesso!');
    }
    


}