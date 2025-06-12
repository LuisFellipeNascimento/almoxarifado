<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Produto;
use App\Models\OrdemFornecimento;
use App\Models\Unidades;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdemExport;
use App\Exports\SaldoExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use OwenIt\Auditing\Models\Audit;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   $unidades = unidades::all();

        $pedidos = pedidos::orderBy('updated_at','desc')->orderBy('created_at','desc')
        ->with('unidades')
        ->when($request->codigo_pedido,function($query) use ($request){
            $query->where('codigo_pedido','like',$request->codigo_pedido);  
        })
        
       ->when($request->id_unidades,function($query) use ($request){
            $query->where('id_unidades','like','%'.$request->id_unidades.'%');  
        })
       
       
       
        ->Paginate(1000)
        ->withQueryString();
    
       
       
        $id_unidades=$request->id_unidades;       
        $codigo_pedido=$request->codigo_pedido;
       
        return view ('pedidos.index',compact('pedidos','unidades','id_unidades','codigo_pedido'));
       

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = unidades::all();
         $Produto = Produto::all();
         
         return view ('pedidos.create',compact('unidades','Produto'));
  
    }

    public function criar(Request $request)
    {
        $unidades = unidades::all();
         $Produto = Produto::all();
         $saidas = Produto::with(['OrdemFornecimentos', 'pedidos'])              
       ->when($request->filled('id_produtos'),function($query) use ($request){
                $query->where('id',$request->id_produtos);  
            })
       ->orderBy('nome_produto','ASC');
     
         
         return view ('pedidos.create',compact('unidades','Produto','saidas'));
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'inputs.*.id_unidades'=>'required',
            'inputs.*.id_produtos'=>'required',       
            'inputs.*.codigo_pedido'=>'required',
            'inputs.*.quantidade'=>'required',
           
        ]  ,
        [ 
            'inputs.*.id_unidades'=>'Escolha o nome da unidade',
            'inputs.*.codigo_pedido'=>'Digite o número do pedido', 
            'inputs.*.id_produtos'=>'Escolha o produto', 
            'inputs.*.quantidade'=>'É preciso definir a quantidade do item',
            
        ]            
    );

   
        
foreach($request->inputs as $key=>$value){
        Pedidos::create($value); }

       
        return redirect()->route('pedidos.index')->with('success','O pedido foi criado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pedidos $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {    $unidades = unidades::all();
        $Produtos = Produto::all();
        $pedidos = Pedidos::findOrFail($id);
        return view ('pedidos.edit',compact('pedidos','unidades','Produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $pedidos = Pedidos::findOrFail($id); 
         
        $campos = $request->validate([ 
            'id_unidades'=>'required',
            'id_produtos'=>'required',       
            'codigo_pedido'=>'required',
            'quantidade'=>'required',

        ]);

        
        $pedidos->update($campos);
                        
        return redirect()->route('pedidos.index')->with('success','O item do pedido foi editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
       public function destroy(Request $request,string $id)
    {
        $pedidos = pedidos::Find($id);
        $pedidos->delete($id);
        return redirect()->route('pedidos.index')->with('success','O  item foi apagada do pedido com sucesso!');
    }

    public function export(Request $request) 
{ 
    // Aumentar o limite de memória temporariamente
    ini_set('memory_limit', '1024M');   
      
    $pedidos = pedidos::orderBy('updated_at','asc')->orderBy('created_at','asc')
    ->with('unidades')
    ->when($request->codigo_pedido,function($query) use ($request){
        $query->where('codigo_pedido','like',$request->codigo_pedido);  
    })
    
   ->when($request->id_unidades,function($query) use ($request){
        $query->where('id_unidades','like','%'.$request->id_unidades.'%');  
    })
      ->orderByDesc('created_at')
       ->get();
       
       $image =base64_encode(file_get_contents(public_path('uploads/foto_produtos/logo-prefeitura.png')));
       
        $pdf = PDF::loadView('pedidos.show',['pedidos' => $pedidos,'image'=> $image]);
        return $pdf->download('recibo.pdf');
}

public function dupla(Request $request) 
{ 
    // Aumentar o limite de memória temporariamente
    ini_set('memory_limit', '1024M');   
      
    $pedidos = pedidos::orderBy('updated_at','asc')->orderBy('created_at','asc')
    ->with('unidades')
    ->when($request->codigo_pedido,function($query) use ($request){
        $query->where('codigo_pedido','like',$request->codigo_pedido);  
    })
    
   ->when($request->id_unidades,function($query) use ($request){
        $query->where('id_unidades','like','%'.$request->id_unidades.'%');  
    })
      ->orderByDesc('created_at')
       ->get();
       
       $image =base64_encode(file_get_contents(public_path('uploads/foto_produtos/logo-prefeitura.png')));
       
        $pdf = PDF::loadView('pedidos.dupla',['pedidos' => $pedidos,'image'=> $image]);
        return $pdf->download('recibo folha dupa.pdf');
}
public function saldo(Request $request)
{ 
       $Produtos = Produto::all();  
       $saidas = Produto::with(['OrdemFornecimentos', 'pedidos'])              
       ->when($request->filled('id_produtos'),function($query) use ($request){
                $query->where('id',$request->id_produtos);  
            })
       ->orderBy('nome_produto','ASC')
       ->Paginate(10);

       $ProdutoselecionadoId = $request->input('id_produtos');

        return view('pedidos.saldo', compact('saidas','Produtos','ProdutoselecionadoId'));
}

public function exportar_saldo(Request $request) 
{ 
    // Aumentar o limite de memória temporariamente
    ini_set('memory_limit', '1024M');

    $saidas = Produto::with(['OrdemFornecimentos', 'pedidos'])              
       ->when($request->id_produtos,function($query) use ($request){
                $query->where('id','like','%'.$request->id_produtos.'%');  
            })
       ->orderBy('nome_produto','ASC')  
       ->get();
       
       $image =base64_encode(file_get_contents(public_path('uploads/foto_produtos/logo-prefeitura.png')));
       
        $pdf = PDF::loadView('pedidos.inventario',['saidas' => $saidas,'image'=> $image]);
        return $pdf->download('Inventário.pdf');
}

public function exportar_excel(Request $request) 
{
    $saidas = Produto::with(['OrdemFornecimentos', 'pedidos'])              
       ->when($request->id_produtos,function($query) use ($request){
                $query->where('id','like','%'.$request->id_produtos.'%');  
            })
       ->orderBy('nome_produto','ASC')  
       ->get();
       return Excel::download(new SaldoExport($saidas),'Saldo Mensal.xlsx');
       
}

public function saida_produto(Request $request)
{ 
       $Materiais = Produto::all();  
       $saidas = pedidos::orderBy('id_produtos','ASC')            
       ->when($request->id_produtos,function($query) use ($request){
                $query->where('id_produtos','like','%'.$request->id_produtos.'%');  
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function($query) use ($request) {
                $start_date = Carbon::parse($request->start_date)->startOfDay();
                $end_date = Carbon::parse($request->end_date)->endOfDay(); // Inclui até o final do dia
                $query->whereBetween('created_at', [$start_date, $end_date]);
            })
        
       
       ->Paginate(100);
       $totalValor = $saidas->sum('quantidade');
       $id_produtos=$request->id_produtos;
       $start_date = $request->start_date;
       $end_date = $request->end_date;
      
       return view('pedidos.saida_produto', compact('saidas','Materiais','totalValor','start_date', 'end_date',));

}

public function atividades(Request $request)
{       $autores = user::all();
       
        $auditorias = Audit::orderBy('updated_at','desc')
        ->with('user')            
       ->when($request->nome_do_usuario,function($query) use ($request){
            $query->where('user_id','like','%'.$request->nome_do_usuario.'%');  
        }) 
       
        ->Paginate(100)
        ->withQueryString();
    
       
       
        $nome_do_usuario=$request->nome_do_usuario;       
  
        return view('pedidos.atividades', compact('auditorias','autores','nome_do_usuario'));
     
    
    
   
}
}