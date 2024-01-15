@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Cadastrar Fornecedor</h1>
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
        
        <label class="control-label mb-1">Fornecedor</label>

        <select name="id_fornecedor"  id="select" class="form-control">
            @if ($Fornecedores->count() > 0)
            <option value="" disabled selected>Selecione um fornecedor</option>
            @foreach ( $Fornecedores as $Fornecedor )
            <option value="{{$Fornecedor->id}}">{{$Fornecedor->nome_fantasia}}</option>
            @endforeach
            @else
            No records
            @endif

        </select>

        <label class="control-label mb-1">Processo</label>

        <select name="id_processo"  id="select" class="form-control">
            @if ($Processos->count() > 0)
            <option value="" disabled selected>Selecione um processo.</option>
            @foreach ( $Processos as $process )
            <option value="{{$process->id}}">{{$process->numero}}</option>
            @endforeach
            @else
            No records
            @endif

        </select>
        <label class="control-label mb-1" >Numero ordem</label>
        <input type="text" class= "form-control"  name="numero_ordem" id="numero_ordem" placeholder="Número do processo" >        
       
        <label class="control-label mb-1">Emissao</label>
        <input type="date" class= "form-control"  name="emissao" id="emissao" placeholder="Número do processo" >        
        <label class="control-label mb-1">Empenho</label>
        <input type="text"  class= "form-control" name="empenho" id="empenho" placeholder="Empenho do processo" >
        <label class="control-label mb-1">Item</label>
        <input type="text"   class= "form-control"name="item" id="item" placeholder="Fornecedor do processo" >
        <label class="control-label mb-1">Valor unitario</label>
        <input type="number"  step="0.01" class= "form-control" name="valor_unitario" id="valor_unitario" placeholder="Digite o telefone" >       
        <label class="control-label mb-1">Quantidade</label>
        <input type="number" step="0.01"   class= "form-control" name="quant_total" id="quant_total" placeholder="Digite o e-mail"  >
        <label class="control-label mb-1">valor total</label>
        <input type="number"  step="0.01"  class= "form-control" name="valor_total" id="valor_total" placeholder="Número da Ordem emitida" >
       
        
        
       <br>
        

 <br>
 
        <button type="submit">Cadastrar</button>


 

    </form>

</div>




@endsection