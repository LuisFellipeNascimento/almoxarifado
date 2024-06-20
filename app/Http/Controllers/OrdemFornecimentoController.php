<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use App\Models\OrdemFornecimento;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;
use App\Exports\OrdemExport;
use Maatwebsite\Excel\Facades\Excel;


class OrdemFornecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   $Processos =Processo::orderBy('numero','desc')->get(); 
        $Fornecedores = Fornecedores::all();   
        $empenho_unico = OrdemFornecimento::distinct()->get(['empenho']);
    
        
            $ordem =  OrdemFornecimento::orderBy('id', 'desc')
            ->with('processo')
            ->when($request->id_processo, function ($query) use ($request) {
                $query->whereIn('id_processo', $request->id_processo);
            })
            ->when($request->id_fornecedor, function ($query) use ($request) {
                $query->where('id_fornecedor', $request->id_fornecedor);
            })
            ->when($request->item, function ($query) use ($request) {
                $query->where('item', $request->item);
            })
            ->when($request->empenho, function ($query) use ($request) {
                $query->where('empenho', $request->empenho);
            })
            ->when($request->numero_ordem, function ($query) use ($request) {
                $query->where('numero_ordem', $request->numero_ordem);
            })
            ->when($request->nota_fiscal, function ($query) use ($request) {
                $query->where('nota_fiscal', $request->nota_fiscal);
            })
            ->when($request->descricao, function ($query) use ($request) {
                $query->where('descricao','like','%'. $request->descricao.'%');
                 
            })
       ->orderByDesc('id_fornecedor')
       ->paginate(500);
       $n1=0;
       foreach ($ordem as $rs) {
       $rs->Processo->numero;
       $n1=$rs->Processo->numero;}
     
       $valorempenhado = Processo::where('numero','like','%'.$n1.'%')->sum('valor');
        //balanço dos valores: quantidade de cada item - oque foi entregue
       $quantidade_total_item_no_processo = Processo::where('item','=',$request->item)->where('numero','like','%'.$n1.'%')->sum('quantidade');
       $quantidade_total_item_entregue = $ordem->sum('quant_total');
       $quantidade_total_item = $quantidade_total_item_no_processo - $quantidade_total_item_entregue;

        //soma do valor total do processo filtrando por ordem      
       $total_ordem = Processo::where('numero_of','like','%'.$request->numero_ordem.'%')->sum('valor');       
       $total_produtos = $ordem->sum('valor_total');       
       $resultado = $valorempenhado - $total_produtos;
            
       //somar por fornecedor
       //$valorFornecedor =  $ordem('id_fonecedor',$request->id_fonecedor)->sum('valor_total');
   
        //balanço dos valores: da O.F com oque foi entregue.
        $resultado_of =  $total_ordem - $total_produtos;

        //total geral da quantidade dos itens com oque foi entregue.
       $valorItem =  Processo::where('numero','like','%'.$n1.'%')
       ->where('item','like','%'.$request->item.'%')       
       ->sum('quantidade');
       $resultado_quantidade = $ordem->sum('quant_total');
       $resultado_confronto =  $valorItem - $resultado_quantidade ;
       

       //recuperar valor selecionado
       $id_processo = $request->id_processo;
       $id_fornecedor = $request->id_fornecedor;
       $item = $request->item;
       $empenho= $request->empenho;
       $numero_ordem= $request->numero_ordem;
       $nota_fiscal= $request->nota_fiscal;
       $descricao= $request->descricao;
       
        return view ('ordem.index', compact('quantidade_total_item_no_processo','total_ordem','resultado_of','ordem','quantidade_total_item','Fornecedores','Processos','total_produtos','resultado','id_processo','id_fornecedor','resultado_quantidade','resultado_confronto','item','empenho','numero_ordem','empenho_unico','descricao','nota_fiscal'));
        
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
            'nota_fiscal'=>['required'],	
            'descricao'=>['required'],		
            'emissao'=>['required'],
            'empenho'=>['required'],
            'item'=>['required'],
            'valor_unitario'=>['required'],
            'valor_total'=>['required'],          
            'quant_total'=>['required'],
            'id_fornecedor'=>['required'],
            'id_processo'=>['required']]) ;
                 
                
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
        'nota_fiscal'=>['required'],
        'descricao'=>['required'],
        'emissao' =>['required'],

        'empenho' =>['required'],

        'item' =>['required'],

        'valor_unitario' =>['required'],

        'valor_total' =>['required'],

        'quant_total' =>['required'],

        'id_fornecedor' =>['required'],

        'id_processo' =>['required']]);

        
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
        return redirect()->back()->with('success','A Ordem de Fornecimento foi apagada com sucesso!');
  
    }


    public function export() 
    {
        return Excel::download(new OrdemExport,'invoices.xlsx');
       
    }

    
}
