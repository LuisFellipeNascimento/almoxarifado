@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar Fornecedor</h1>
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
    
    <form  action="{{route('fornecedor.update',$Fornecedores->id)}}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        @if(Session::has('success'))
           <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
           </div>
        @endif   
        <label class="control-label mb-1" >Nome Fantasia</label>
        <input type="text" class= "form-control"  name="nome_fantasia"  value="{{$Fornecedores->nome_fantasia}}">        
       
        <label class="control-label mb-1">Razão Social</label>
        <input type="text" class= "form-control"  name="razao_social" id="razao_social" placeholder="Número do processo" value="{{$Fornecedores->razao_social}}"   >        
        <label class="control-label mb-1">nome_representante</label>
        <input type="text"  class= "form-control" name="nome_representante" id="nome_representante" placeholder="Empenho do processo" value="{{$Fornecedores->nome_representante}}">
        <label class="control-label mb-1"> Inscricão Estadual</label>
        <input type="text"   class= "form-control"name="inscricao_estadual" id="inscricao_estadual" placeholder="Fornecedor do processo" value="{{$Fornecedores->inscricao_estadual}}">
        <label class="control-label mb-1"> Telefone de contato</label>
        <input type="text"   class= "form-control" name="telefone" id="telefone" placeholder="Digite o telefone" value="{{$Fornecedores->telefone}}">
        <label class="control-label mb-1"> Telefone de contato reserva</label>
        <input type="text"   class= "form-control" name="telefone2" id="telefone2" placeholder="Número" value="{{$Fornecedores->telefone2}}">

        <label class="control-label mb-1">Endereço</label>
        <textarea  class= "form-control" name="endereco" id="endereco" placeholder="Digite o endereço do fornecedor"  >{{$Fornecedores->endereco}}</textarea>
        <label class="control-label mb-1">E-mail</label>
        <input type="email"   class= "form-control" name="email" id="email" placeholder="Digite o e-mail" value="{{$Fornecedores->email}}" >
        <label class="control-label mb-1">CNPJ</label>
        <input type="text"   class= "form-control" name="cnpj" id="cnpj" placeholder="Digite o CNPJ" value="{{$Fornecedores->cnpj}}">
        <label class="control-label mb-1">Observação</label>
        <textarea  class= "form-control" name="observacao" id="observacao" placeholder="Diga algum detalhe do fornecedor"  >{{$Fornecedores->observacao}}</textarea>
        
  
 <br>
 
        <button type="submit">Editar</button>


 

    </form>

</div>




@endsection