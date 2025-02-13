@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de Saidas Cadastradas</h1>
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
            <a href="{{ route('pedidos.create') }}" class="btn btn-success">Adicionar saida</a>       
            <a href="{{ url('pedidos.show?'.request()->getQueryString()) }}" class="btn btn-danger">Exportar</a>    
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Saidas</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="codigo_pedido" name="codigo_pedido" placeholder="Código do pedido" value="{{$codigo_pedido}}" >
               
                             
                <select name="id_unidades"  id="select3" class="form-control" >
                    @if ($unidades->count() > 0)
                    <option value="" selected>Selecione uma unidade</option>
                    @foreach ( $unidades as $unidade )
                    <option value="{{$unidade->id}}"
                        {{ $unidade->id == $id_unidades ? 'selected' : '' }}> 
                        {{$unidade->nome_unidade}}</option>
                    @endforeach
                    @else
                    No records
                    @endif

                   
                                            
                </select>
                                                                                 
            </div>
            
            <div>
            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-warning mb-2">Limpar</a>
            </div>
        </form>





        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
    
            <thead>
                <tr> 
                    <th style="width:5%" >Item</th>
                    <th style="width:5%">Número do pedido</th>
                    <th style="width:40%">Unidade</th>
                    <th style="width:40%">Produto</th>
                    <th style="width:5%">Quantidade</th>
                    <th class="text-center" style="width:5%">Ação</th>
                    

                </tr>
            </thead>

            <tbody>
                @if ($pedidos->count() > 0)
                    @foreach ($pedidos as $rs)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $rs->codigo_pedido }}</td>
                            <td class = "align-middle">{{ $rs->unidades->nome_unidade }}</td>
                            <td class = "align-middle">{{ $rs->Produto->nome_produto }}</td>
                            <td class = "align-middle">{{ $rs->quantidade }}</td>
                            <td class = "align-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('pedidos.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('pedidos.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#mediumModal-{{$rs->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        @include('pedidos.MediumModal')
                                </div>
                            </td>
                          
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="6" style="text-align: center">Não existem pedidos cadastrados.</td>
                    </tr>
                @endif
               
            </tbody>
        </table>
        <div class="d-flex">      
            Total de itens: {!! $pedidos->total() !!}
        </div>       
        <div class="d-flex">
           
            Página atual: {!! $pedidos->currentPage() !!}
        </div>
        <div class="d-flex">
            {!! $pedidos->links() !!}
           
        </div>

    </div>

    <script>
   
        $('select').select2({
        theme: 'bootstrap4',
    });
</script>

@endsection
