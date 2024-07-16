@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar Produto</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Produto</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <form  action="{{route('produto.update',$produto->id)}}" enctype="multipart/form-data" method="POST">
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
            
            <label class="control-label mb-1" >Nome</label>
            <input type="text" class= "form-control"  name="nome" id="nome" value="{{ $produto->nome}}" > 
            <label class="control-label mb-1" >Data de Vencimento</label>
            <input type="date" class= "form-control"  name="vencimento" id="vencimento" value="{{ $produto->vencimento}}" >  
            <label class="control-label mb-1">Quantidade</label>
            <input type="number" step="0.01"  class= "form-control" name="quant_total" id="quant_total"  value="{{$produto->quant_total}}" >
            <label class="control-label mb-1">Local de recebimento</label>    
            <input type="text"  class= "form-control"   name="local" id="local"  value="{{$produto->local}}"  > 
       
            <label class="control-label mb-1">Estoque minimo</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_min"   id="estoque_min"  value="{{$produto->estoque_min}}"  >
            
            <label class="control-label mb-1">Estoque ideal</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_ideal" id="estoque_ideal"  value="{{$produto->estoque_ideal}}"  >
         
            <label class="control-label mb-1">Valor unitario</label>
            <input type="number" step="0.01"   class= "form-control" name="valor_unitario"  id="valor_unitario"  value="{{$produto->valor_unitario}}"  >
           
           
            <label class="control-label mb-1">Valor saida</label>
            <input type="number" step="0.01"   class= "form-control" name="valor_saida"  id="valor_saida"  value="{{$produto->valor_saida}}"  >
            <label class="control-label mb-1">Código de barras</label>
            <input type="text"   class= "form-control" name="codigobarras"  id="codigobarras"  value="{{$produto->codigobarras}}"  >
             
            <label class="control-label mb-1">Foto</label>
            <a href="{{ asset ($produto->foto) }}" data-fancybox   data-caption="{{$produto->nome}}">
           <img  name="foto2"  class="img-fluid" src="{{asset($produto->foto) }}" style="width: 100px; height: 100px;" alt="img"/>
            </a>
            <input type="file"   class= "form-control" name="foto" id="foto" >                
            <label class="control-label mb-1">Observação</label>
            <textarea  class= "form-control" name="observacao" id="observacao">{{$produto->observacao}}</textarea>
            
    
     <br>
     
            <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
    
    
     
    
        </form>
    
    </div>
 

@endsection
