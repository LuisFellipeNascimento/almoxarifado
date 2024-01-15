@extends('web.home')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ver dados da Ordem</h1>
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
     
        <label class="control-label mb-1" >Fornecedor</label>
        <input type="text" class= "form-control"  name="id_fornecedor" id="id_fornecedor" value="{{$OrdemFornecimento->Fornecedores->nome_fantasia}}" readonly>        
       
        <label class="control-label mb-1">Processo</label>
        <input type="text" class= "form-control"  name="processo" id="processo"  value="{{$OrdemFornecimento->processo->numero}}"readonly>        
        <label class="control-label mb-1">Emissão</label>
        <input type="date"  class= "form-control" name="emissao" id="emissao"  value="{{$OrdemFornecimento->emissao}}" readonly>
        <label class="control-label mb-1"> Número da Ordem</label>
        <input type="text"   class= "form-control"name="numero_ordem" id="numero_ordem"  value="{{$OrdemFornecimento->numero_ordem}}" readonly>
        <label class="control-label mb-1"> Empenho</label>
        <input type="text"   class= "form-control" name="empenho" id="empenho"  value="{{$OrdemFornecimento->empenho}}" readonly>
        <label class="control-label mb-1"> Item</label>
        <input type="text"   class= "form-control" name="item" id="item"  value="{{$OrdemFornecimento->item}}"  readonly>

        <label class="control-label mb-1">valor Unitário</label>
        <textarea  class= "form-control" name="valor_unitario" id="valor_unitario" readonly >{{$OrdemFornecimento->valor_unitario}}</textarea>
        <label class="control-label mb-1">Quantidade </label>
        <input type="text"   class= "form-control" name="quant_total" id="quant_total" value="{{$OrdemFornecimento->quant_total}}" readonly >
        <label class="control-label mb-1">Valor total</label>
        <input type="text"   class= "form-control" name="valor_total" id="valor_total"  value="{{$OrdemFornecimento->valor_total}}"  readonly>
    

         
</div>




@endsection