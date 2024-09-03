@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar o Pedido</h1>
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
    
    <form  action="{{route('pedidos.update',$pedidos->id)}}" method="POST" id="form-id">
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
        <label class="control-label mb-1" >Número do pedido</label><br>  
        <input type="text" name="codigo_pedido" id="codigo_pedido" class="form-control" placeholder="Digite o nome da unidade"  value="{{old('descricao',$pedidos->codigo_pedido)}}">
          
        <label class="control-label mb-1" >Unidades</label><br>  
        <select name="id_unidades"  id="select1" class="form-control">

            <option value = "{{ $pedidos->id_unidades}}"  @if ($pedidos->id_unidades ===$pedidos->unidades->nome) {'selected':''}  @endif> {{$pedidos->unidades->nome}}</option>

            @foreach ( $unidades as $Process )
            <option  value="{{$Process->id}}" >{{$Process->nome}}</option>
            @endforeach
        </select><br> 

        <label class="control-label mb-1" >Produtos</label><br>  
        <select name="id_produtos"  id="select" class="form-control">

            <option value = "{{ $pedidos->id_produtos}}"  @if ($pedidos->id_produtos ===$pedidos->Produtos->nome) {'selected':''}  @endif> {{$pedidos->Produtos->nome}}</option>

            @foreach ( $Produtos as $Process )
            <option  value="{{$Process->id}}" >{{$Process->nome}}</option>
            @endforeach
        </select><br> 
        <label class="control-label mb-1" >Quantidade</label><br> 
       <input type="number" step=".01" class= "form-control" name="quantidade" value="{{old('quantidade',$pedidos->quantidade)}}">
          

        
  
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