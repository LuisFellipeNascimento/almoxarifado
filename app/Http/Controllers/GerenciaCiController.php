<?php

namespace App\Http\Controllers;

use App\Models\GerenciaCi;
use Illuminate\Http\Request;
use App\Models\Unidades;

class GerenciaCiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unidades = Unidades::all();
        $controle_ci =  GerenciaCi::orderBy('created_at', 'desc')       
     
        ->when($request->numero_ci, function ($query) use ($request) {
            $query->where('numero_ci', $request->numero_ci);
        })
        ->when($request->data_inicial_recebimento && $request->data_final_recebimento, function ($query) use ($request) {
            $query->whereBetween('recebimento_ci', [$request->data_inicial_recebimento, $request->data_final_recebimento]);
        })

        ->when($request->data_inicial_atendimento && $request->data_final_atendimento, function ($query) use ($request) {
            $query->whereBetween('atendimento_ci', [$request->data_inicial_atendimento, $request->data_final_atendimento]);             
        })
      
        ->when($request->data_inicial_resposta && $request->data_final_resposta, function ($query) use ($request) {
            $query->whereBetween('data_resposta', [$request->data_inicial_resposta, $request->data_final_resposta]);
        })
      
        ->when($request->descricao, function ($query) use ($request) {
            $query->where('descricao','like','%'. $request->descricao.'%');
             
        })

        ->when($request->status, function ($query) use ($request) {
            $query->where('status','like',$request->status);
             
        })

        ->when($request->id_unidades, function ($query) use ($request) {
            $query->where('id_unidades','like',$request->id_unidades);
             
        })
       
        ->Paginate(10)
        ->withQueryString();

       $numero_ci = $request->numero_ci;
       $descricao = $request->descricao;      
       $atendimento_ci = $request->atendimento_ci;
      
       $status = $request->status;
       $id_unidades=$request->id_unidades;
       
       $data_inicial_atendimento = $request->data_inicial_atendimento;
       $data_final_atendimento = $request->data_final_atendimento;

       $data_inicial_recebimento = $request->data_inicial_recebimento;
       $data_final_recebimento = $request->data_final_recebimento;

       $data_inicial_resposta = $request->data_inicial_resposta;
       $data_final_resposta = $request->data_final_resposta;
        
       return view ('gerenciarci.index',compact('controle_ci','unidades','numero_ci','descricao','atendimento_ci','data_inicial_resposta','data_final_resposta','status','id_unidades','data_inicial_atendimento','data_final_atendimento','data_inicial_recebimento','data_final_recebimento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = unidades::all();
               
         return view ('gerenciarci.create',compact('unidades'));
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([             
            'numero_ci'=>'required',	
            'descricao'=>['required'],
            'recebimento_ci'=>['required'],
            'data_resposta'=>['nullable'],           
            'atendimento_ci'=>['nullable'],
            'id_unidades'=>['required'],
            'status'=>['required'],
            
            ]) ;
        
            GerenciaCi::create([
        'numero_ci'=>$request->numero_ci,	
        'descricao'=>$request->descricao,
        'recebimento_ci'=>$request->recebimento_ci,
        'data_resposta'=>$request->data_resposta,
        'atendimento_ci'=>$request->atendimento_ci,           
        'id_unidades'=>$request->id_unidades,  
        'status'=>$request->status,
          ]);
       
         return redirect()->route('gerenciarci.index')->with('success','A C.I foi cadastrada com sucesso!');

    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Unidades =Unidades::all();
        $controle_ci = GerenciaCi::findOrFail($id);
        return view ('gerenciarci.edit',compact('Unidades','controle_ci'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $controle_ci = GerenciaCi::findOrFail($id);   
        $campos = $request->validate([             
            'numero_ci'=>'required',	
            'descricao'=>['required'],
            'recebimento_ci'=>['required'],
            'data_resposta'=>['nullable'],           
            'atendimento_ci'=>['nullable'],
            'id_unidades'=>['required'],
            'status'=>['required'],
            
            ]);

          $controle_ci->update($campos);
       
          return redirect()->route('gerenciarci.index')->with('success','A C.I foi editada com sucesso!');     
    }
   

    public function destroy(Request $request,string $id)
    {
       $controle_ci = GerenciaCi::Find($id);
        $controle_ci->delete($id);
        return redirect()->back()->with('success','A C.I foi apagada com sucesso!');
    }
}
