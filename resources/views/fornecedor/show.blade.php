@extends('web.home')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ver dados Fornecedor</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
  
      
        @if(Session::has('success'))
           <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
           </div>
        @endif   
        <label class="control-label mb-1" >Nome Fantasia</label>
        <input type="text" class= "form-control"  name="nome_fantasia" id="nome_fantasia" placeholder="Número do processo" value="{{$Fornecedores->nome_fantasia}}" readonly>        
       
        <label class="control-label mb-1">Razão Social</label>
        <input type="text" class= "form-control"  name="razao_social" id="razao_social" placeholder="Número do processo" value="{{$Fornecedores->razao_social}}"readonly>        
        <label class="control-label mb-1">nome_representante</label>
        <input type="text"  class= "form-control" name="nome_representante" id="nome_representante" placeholder="Empenho do processo" value="{{$Fornecedores->nome_representante}}" readonly>
        <label class="control-label mb-1"> Inscricão Estadual</label>
        <input type="text"   class= "form-control"name="inscricao_estadual" id="inscricao_estadual" placeholder="Fornecedor do processo" value="{{$Fornecedores->inscricao_estadual}}" readonly>
        <label class="control-label mb-1"> Telefone de contato</label>
        <input type="text"   class= "form-control" name="telefone" id="telefone" placeholder="Digite o telefone" value="{{$Fornecedores->telefone}}" readonly>
        <label class="control-label mb-1"> Telefone de contato reserva</label>
        <input type="text"   class= "form-control" name="telefone2" id="telefone2" placeholder="Número da Ordem emitida" value="{{$Fornecedores->telefone2}}"  readonly>

        <label class="control-label mb-1">Endereço</label>
        <textarea  class= "form-control" name="endereco" id="endereco" placeholder="Digite o endereço do fornecedor"  readonly >{{$Fornecedores->endereco}}</textarea>
        <label class="control-label mb-1">E-mail</label>
        <input type="email"   class= "form-control" name="email" id="email" placeholder="Digite o e-mail" value="{{$Fornecedores->email}}" readonly >
        <label class="control-label mb-1">CNPJ</label>
        <input type="text"   class= "form-control" name="cnpj" id="cnpj" placeholder="Digite o CNPJ" value="{{$Fornecedores->cnpj}}"  readonly>
        <label class="control-label mb-1">Observação</label>
        <textarea  class= "form-control" name="observacao" id="observacao" placeholder="Diga algum detalhe do fornecedor" readonly >{{$Fornecedores->observacao}}</textarea>
        


</div>




@endsection