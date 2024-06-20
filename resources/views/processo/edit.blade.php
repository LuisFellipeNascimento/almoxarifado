@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar Ordem Processo</h1>
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
    
    <form  action="{{route('processo.update',$Processo->id)}}" method="POST" id="form-id">
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
        <label class="control-label mb-1" >Número do processo</label>
        <input type="text" class= "form-control"  name="numero" id="numero" value="{{old ('numero',$Processo->numero)}}">
        <label class="control-label mb-1" >Descrição</label>
        <input type="text" class= "form-control"  name="descricao"  value="{{old('descricao',$Processo->descricao)}}">        
        <label class="control-label mb-1" >Fornecedor</label><br>  
        <select name="id_fornecedor"  id="select" class="form-control">

            <option value = "{{ $Processo->id_fornecedor}}"  @if ($Processo->id_fornecedor ===$Processo->fornecedores->numero) {'selected':''}  @endif> {{$Processo->Fornecedores->nome_fantasia}}</option>

            @foreach ( $Fornecedores as $Process )
            <option  value="{{$Process->id}}" >{{$Process->nome_fantasia}}</option>
            @endforeach
        </select><br> 
        <label class="control-label mb-1" >Número da O.F</label>
        <input type="text" class= "form-control"  name="numero_of"  value="{{old('numero_of',$Processo->numero_of)}}">        
        <label class="control-label mb-1" >Item</label>
        <input type="text" class= "form-control"  name="item"  value="{{old('item',$Processo->item)}}">        
        <label class="control-label mb-1" >Quantidade</label>
        <input type="number" step=".01"  class= "form-control"  name="quantidade"  value="{{old('quantidade',$Processo->quantidade)}}">        
        
        <label class="control-label mb-1" >Valor total empenhado</label>
        <input type="number" step=".01" class= "form-control" id="valor"  name="valor"  value="{{old('valor',$Processo->valor)}}"> 
        
  
 <br>

        <button type="submit" class="btn btn-primary btn-lg btn-block medio">Editar</button>
  </form>

</div>



<script>
   
    $('select').select2({
    theme: 'bootstrap4',
});
</script>

@endsection