@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Cadastrar Ordem de Fornecimento</h1>
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
    <form  action="{{route('ordem.store')}}" method="POST">
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
        <label class="control-label mb-1" >Número da ordem de fornecimento</label>
        <input type="text" class= "form-control"  name="numero_ordem" id="numero_ordem" placeholder="Número da ordem de fornecimento" value="{{ old('numero_ordem')}}" >
          
        <label class="control-label mb-1">Emissao</label>
        <input type="date" class= "form-control"  name="emissao" id="emissao" placeholder="Número do processo" value="{{ old('emissao')}}" >        
         

        <label class="control-label mb-1">Fornecedor</label><br>

        <select name="id_fornecedor"  id="select3" class="form-control select " >
            @if ($Fornecedores->count() > 0)
            <option value="" disabled selected>Selecione um fornecedor</option>
            @foreach ( $Fornecedores as $Fornecedor )
            <option value="{{$Fornecedor->id}}">{{$Fornecedor->nome_fantasia}}</option>
            @endforeach
            @else
            No records
            @endif

        </select><br>

        <label class="control-label mb-1">Processo</label><br>

        <select name="id_processo"  id="select2" class="form-control select " >
            @if ($Processos->count() > 0)
            <option value="" disabled selected>Selecione um processo.</option>
            @foreach ( $Processos as $process )
            <option value="{{$process->id}}">{{$process->numero}}</option>
            @endforeach
            @else
            No records
            @endif

        </select><br>
         
        <label class="control-label mb-1">Empenho</label>
        <input type="text"  class= "form-control" name="empenho" id="empenho" placeholder="Empenho do processo" value="{{ old('empenho')}}" >
       
       
        <label class="control-label mb-1">Item</label>
        <input type="text"   class= "form-control"name="item" id="item" placeholder="Item do processo" value="{{ old('item')}}" >
        <label class="control-label mb-1">Descrição</label>
        <input type="text"   class= "form-control"name="descricao" id="descricao" placeholder="descricao do processo" value="{{ old('descricao')}}" >
        <label class="control-label mb-1">Nota Fiscal</label>
        <input type="text"   class= "form-control"name="nota_fiscal" id="nota_fiscal" placeholder="Número da notafiscal" value="{{ old('nota_fiscal')}}" >
        <label class="control-label mb-1">Valor unitario</label>
        <input type="number" step="0.01" class= "form-control" name="valor_unitario" onblur="soma()" id="valor_unitario" value="{{ old ('valor_unitario')}}" >       
        <label class="control-label mb-1">Quantidade</label>
        <input type="number" step="0.01"  class= "form-control" name="quant_total" id="quant_total" onblur="soma()" value="{{ old('quant_total')}}"  >
        <label class="control-label mb-1">valor Total</label>
        <input type="text"  class= "form-control"    name="valor_total"   readonly id="valor_total"   >
       
        
        
       <br>
        

 <br>
 
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>


 

    </form>

</div>

<script>
   
    $('select').select2({
    theme: 'bootstrap4',
});

</script>



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

