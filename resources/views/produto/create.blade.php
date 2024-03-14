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
        <form  action="{{route('produto.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
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
            <input type="text" class= "form-control"  name="nome" id="nome" value="{{ old('nome')}}" placeholder="Ex.: Lápis"  >  
            <label class="control-label mb-1" >Data de Vencimento</label>
            <input type="date" class= "form-control"  name="vencimento" id="vencimento" value="{{ old('vencimento')}}" >  
            
            <label class="control-label mb-1">Quantidade</label>
            <input type="number" step="0.01"  class= "form-control" name="quant_total" id="quant_total"  value="{{ old('quant_total')}}" placeholder="Ex.: Digite a quantidade da compra"  >
            <label class="control-label mb-1">Local de recebimento</label>    
            <input type="text"  class= "form-control"   name="local" id="local"  value="{{ old('local')}}"  placeholder="Ex.:Almoxarifado SMEC, Patrimonio, Reta" > 
       
            <label class="control-label mb-1">Estoque minimo</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_min"   id="estoque_min"  value="{{ old('estoque_min')}}" placeholder="Ex.: 50,10,500" >
            
            <label class="control-label mb-1">Estoque ideal</label>
            <input type="number" step="0.01"   class= "form-control" name="estoque_ideal" id="estoque_ideal"  value="{{ old('estoque_ideal')}}" placeholder="Ex.: 50,10,500" >
         
            <label class="control-label mb-1">Valor unitario</label>
            <input type="number" step="0.01"   class= "form-control" name="valor_unitario"  id="valor_unitario"  value="{{ old('valor_unitario')}}" placeholder="Ex.: 1.50" >
           
           
            <label class="control-label mb-1">Valor saida</label>
            <input type="number" step="0.01"   class= "form-control" name="valor_saida"  id="valor_saida"  value="{{ old('valor_saida')}}" placeholder="Ex.: 1.50" >
            <label class="control-label mb-1">Código de barras</label>
            <input type="text"   class= "form-control" name="codigobarras"  id="codigobarras"  value="{{ old('codigobarras')}}" placeholder=" Digite o codigo de barras, Ex.: 789852" >
             
            <label class="control-label mb-1">Foto</label>
            <input type="file"   class= "form-control" name="foto" id="foto">                
            <label class="control-label mb-1">Observação</label>
            <textarea  class= "form-control" name="observacao" id="observacao"  value="{{ old('observacao')}}" placeholder="Diga algum detalhe relevante do produto"  ></textarea>
            
    
     <br>
     
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
    
    
     
    
        </form>
    
    </div>
 

@endsection
