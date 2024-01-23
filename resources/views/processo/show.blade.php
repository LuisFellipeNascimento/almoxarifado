@extends('web.home')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ver dados Processo</h1>
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
        <label class="control-label mb-1" >Número</label>
        <input type="text" class= "form-control"  name="numero" id="numero" placeholder="Número do processo" value="{{$Processo->numero}}" readonly>        
        <label class="control-label mb-1" >Descrição</label>
        <input type="text" class= "form-control"  name="descricao" id="descricao" placeholder="" value="{{$Processo->descricao}}" readonly>
        <label class="control-label mb-1" >Total</label>
        <input type="text" class= "form-control"  name="valor" id="valor" placeholder="Número do processo" value="{{$Processo->valor}}" readonly>        
       
        
</div>




@endsection