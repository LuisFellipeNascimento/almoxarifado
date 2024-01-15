@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
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
    <form  action="{{route('web.store')}}" method="POST">
        @csrf
        <label> Numero do processo </label>
        <input type="text" class= "form-control"  name="numero" id="numero" placeholder="Número do processo" require>

        <label>Assunto </label>
        <input type="text"  class= "form-control" name="assunto" id="assunto" placeholder="Descrição do processo"require>
        <label>Empenho </label>
        <input type="text"  class= "form-control" name="empenho" id="empenho" placeholder="Empenho do processo" require>
        <label> Fornecedor </label>        
              
         <select name="id_fornecedor"  id="select" class="form-control">

            <option value="" disabled selected>Selecione um fornecedor</option>
            @foreach ( $fornecedores as $fornecedor )
            <option value="{{$fornecedor->id}}">{{$fornecedor->nome_fantasia}}</option>
            @endforeach
         </select>
       <br>
         <label> Ordem de Fonecimento </label>
        <input type="text"   class= "form-control" name="ordem_fornecimento" id="ordem_fornecimento" placeholder="Número da Ordem emitida" require>
 <button type="submit">Cadastrar</button>

    </form>

</div>




@endsection