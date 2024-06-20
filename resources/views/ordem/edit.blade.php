@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar Ordem</h1>
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
    
    <form  action="{{route('ordem.update',$OrdemFornecimento->id)}}" method="POST">
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
        <label class="control-label mb-1">Fornecedor</label>

        

        <select name="id_fornecedor"  id="select" class="form-control">

            <option value = "{{ $OrdemFornecimento->id_fornecedor}}"  @if ($OrdemFornecimento->id_fornecedor ===$OrdemFornecimento->fornecedores->numero) {'selected':''}  @endif> {{$OrdemFornecimento->Fornecedores->nome_fantasia}}</option>

            @foreach ( $Fornecedores as $Process )
            <option  value="{{$Process->id}}" >{{$Process->nome_fantasia}}</option>
            @endforeach
        </select>

        <label class="control-label mb-1">Processo</label>

        <select name="id_processo"  id="select" class="form-control">
      
            <option value = "{{ $OrdemFornecimento->id_processo}}"  @if ($OrdemFornecimento->id_processo ===$OrdemFornecimento->Processo->numero) {'selected':''}  @endif> {{$OrdemFornecimento->Processo->numero}}</option>
            @foreach ( $Processo as $Process )
            <option  value="{{$Process->id}}" >{{$Process->numero}}</option>
            @endforeach
           
        </select>
        <label class="control-label mb-1" >Numero ordem</label>
        <input type="text" class= "form-control"  name="numero_ordem" id="numero_ordem" value="{{$OrdemFornecimento->numero_ordem}}" >        
       
        <label class="control-label mb-1">Emissão</label>
        <input type="date"  class= "form-control" name="emissao" id="emissao"  value="{{$OrdemFornecimento->emissao}}" >
        <label class="control-label mb-1"> Número da Ordem</label>
        <input type="text"   class= "form-control"name="numero_ordem" id="numero_ordem"  value="{{$OrdemFornecimento->numero_ordem}}" >
        <label class="control-label mb-1">Empenho</label>
        <input type="text"   class= "form-control" name="empenho" id="empenho"  value="{{$OrdemFornecimento->empenho}}" >
        <label class="control-label mb-1"> Item</label>
        <input type="text"   class= "form-control" name="item" id="item"  value="{{$OrdemFornecimento->item}}"  >
        <label class="control-label mb-1"> Descrição</label>
        <textarea  class= "form-control" name="descricao" id="descricao">  {{$OrdemFornecimento->descricao}}  </textarea> 
        <label class="control-label mb-1">Número da Nota Fiscal</label>
        <input type="text"   class= "form-control" name="nota_fiscal" id="nota_fiscal"  value="{{$OrdemFornecimento->nota_fiscal}}"  >

        <label class="control-label mb-1">valor Unitário</label>
        <input type="number" step="0.01" class= "form-control" name="valor_unitario" onblur="soma()" id="valor_unitario" value="{{$OrdemFornecimento->valor_unitario}}">
        <label class="control-label mb-1">quant_total</label>
        <input type="number" step="0.01"   class= "form-control" name="quant_total" onblur="soma()" id="quant_total" value="{{$OrdemFornecimento->quant_total}}"  >
        <label class="control-label mb-1">Valor total</label>
        <input type="text"   class= "form-control" name="valor_total" id="valor_total"  value="{{$OrdemFornecimento->valor_total}}"  readonly  >
    
        
       <br>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Editar</button>


    </form>

</div>

<script type="text/javascript"> 

    function id(valor_campo)
    {
        return document.getElementById(valor_campo);
    }
    function getValor(valor_campo)
    {
        var valor = document.getElementById(valor_campo).value.replace( ',', '.');
        /*document.write("Valor: " + valor);*/
        return parseFloat( valor );
    }
    
    function soma()
    {
        var total = getValor('quant_total') * getValor('valor_unitario');
        id('valor_total').value = total;
    }
    </script>

@endsection