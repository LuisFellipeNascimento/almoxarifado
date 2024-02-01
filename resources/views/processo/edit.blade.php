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
    
    <form  action="{{route('processo.update',$Processo->id)}}" method="POST">
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
        <input type="text" class= "form-control"  name="numero" id="numero" value="{{old ('numero',$Processo->numero)}}"><br>
        <label class="control-label mb-1" >Descrição</label>
        <input type="text" class= "form-control"  name="descricao"  value="{{old('descricao',$Processo->descricao)}}"><br>        
        <label class="control-label mb-1" >Valor total empenhado</label>
        <input type="text" class= "form-control" id="valor"  name="valor"  value="{{old('valor',$Processo->valor)}}"><br> 
        
  
 <br>
 
        <button type="submit">Editar</button>


 

    </form>

</div>

<script>
    $(function(){
        $('#valor').maskMoney({ allowNegative: true, thousands:'.', decimal:',', affixesStay: true,});
       
    })
    
</script>

@endsection