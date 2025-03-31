@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Saldo em estoque.</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
   
        <div class="float-right">                
            <a href="{{ url('pedidos.inventario?'.request()->getQueryString()) }}" class="btn btn-danger">Exportar</a>
            <form method="GET" action="{{ route('pedidos.saldo_excel') }}" class="form-inline mb-4"> 
                <button type="submit" class="btn btn-primary">Exportar p/ Excel</button>  
            </form>    
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Materiais</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>                                            
                <select name="id_produtos" id="select" class="form-control select"  style="width:650px;">
                    @if ($Produtos->count() > 0)
                        <option value="" disabled selected>Selecione um produto.</option>
                        @foreach ($Produtos as $Produto)
                            <option value="{{ $Produto->id }}">{{ $Produto->nome_produto }}</option>
                        @endforeach
                    @else
                        No records
                    @endif

                    @if ($Produtos->count() > 0)
                        <option value="" disabled selected {{ old('id_produtos', $ProdutoselecionadoId ?? '') === null ? 'selected' : '' }}>Selecione um produto.</option>
                        @foreach ($Produtos as $Produto)
                            <option value="{{ $Produto->id }}" {{ (old('id_produtos') == $Produto->id || (isset($ProdutoselecionadoId) && $ProdutoselecionadoId == $Produto->id)) ? 'selected' : '' }}>
                                {{ $Produto->nome_produto }}
                            </option>
                        @endforeach
                    @else
                        Não existem Produtos cadastradas.
                    @endif
                                                    
                </select>
                                                                                 
            </div>
            
            <div>
            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
            <a href="{{ route('pedidos.saldo') }}" class="btn btn-warning mb-2">Limpar</a>
            </div>
        </form>



        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
    
            <thead>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Código</th>
                <th>Código Antigo</th>
                <th>Local de Armazenamento</th>
                <th>Quantidade</th>
                <th>Valor unitário</th>
                <th>Valor Total</th>
                <th>Validade</th>
                

            
            </tr>
        </thead>
        <tbody>
            @foreach ($saidas as $saida)
                <tr>
                    
                    <td>{{ $saida->nome_produto }}</td>
                    <td>{{ $saida->id }}</td>
                    <td>{{ $saida->codigobarras }}</td>
                    <td>{{ $saida->local }}</td>
                    <td>{{ $saida->saldo_atual }}</td>
                    <td>{{ $saida->valor_saida }}</td>
                    <td>{{ $saida->saldo_atual*$saida->valor_saida }}</td>
                    <td>{{ Carbon\Carbon::parse($saida->vencimento)->format('d/m/Y')}}</td>
                 
                  
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $saidas->links() !!}
       
    </div>

    <script>
   
        $('select').select2({
        theme: 'bootstrap4',
    });
</script>

    @endsection
