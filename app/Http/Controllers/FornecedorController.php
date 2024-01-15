<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrdemFornecimentoController;
use App\Models\Fornecedores;
use Illuminate\Http\Request;
use App\Models\OrdemFornecimento;

class FornecedorController extends Controller
{
  
    public function index()
    {
        $Fornecedores = Fornecedores::orderBy('created_at','DESC')->Paginate(5);
        return view ('fornecedor.lista_fornecedor',compact('Fornecedores'));
    }

    public function create()
    {
        return view ('fornecedor.create');
    }

    public function store(Request $request)
    { $campos = $request->validate([ 
            'nome_fantasia'=>['required','unique:Fornecedores'],	
            'razao_social'=>['required'],
            'nome_representante'=>['required'],
            'inscricao_estadual'=>['required'],
            'telefone'=>['required'],
            'telefone2'=>['nullable'],
            'endereco'=>['required'],
            'email'=>['required'],
            'cnpj'=>['required'],
            'observacao'=>['nullable']]) ;
            Fornecedores::create($campos);
         
       
         return redirect()->route('lista-fornecedor')->with('success','O fornecedor foi cadastrado com sucesso!');

    }
    public function show(string $id)
    {
        $Fornecedores = Fornecedores::findOrFail($id);
        return view ('fornecedor.show',compact('Fornecedores'));
    }

    public function edit(string $id)
    {
        $Fornecedores = Fornecedores::findOrFail($id);
        return view ('fornecedor.edit',compact('Fornecedores'));
    }
    
    public function update(Request $request,string $id)
    {
        $Fornecedores = Fornecedores::findOrFail($id);   
        
        $request->validate([ 
    'nome_fantasia'=>['required','unique:Fornecedores'],	
    'razao_social'=>'required',
    'nome_representante'=>'required',
    'inscricao_estadual'=>'required',
    'telefone'=>'required',
    'telefone2'=>'nullable',
    'endereco'=>'required',
    'email'=>'required',
    'cnpj'=>'required',
    'observacao'=>'nullable']);
                        
                        $Fornecedores->update($request->all());
                        
        return redirect()->route('lista-fornecedor')->with('success','O fornecedor foi editado com sucesso!');
    }

    public function destroy(Request $request,string $id)
    { 
        $Fornecedores = Fornecedores::Find($id);
        $Fornecedores->delete($id);
        return redirect()->route('lista-fornecedor')->with('success','O fornecedor foi apagado com sucesso!');
    }
    

}
