@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de Processos Cadastrados</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">{{$nome}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="float-right">
            <a href="{{ route('processo.create') }}" class="btn btn-success">Adicionar Processos</a>       
              
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Processo</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Número do Processo" value="{{$nome}}" required>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{$descricao}}">
                <input type="text" class="form-control" id="item" name="item" placeholder="item" value="{{$item}}">
                <input type="text" class="form-control" id="numero_of" name="numero_of" placeholder="Número da O.F" value="{{$numero_of}}">
                <select name="id_fornecedor"  id="select3" class="form-control" >
                    @if ($Fornecedores->count() > 0)
                    <option value="" selected>Selecione um fornecedor</option>
                    @foreach ( $Fornecedores as $Fornecedor )
                    <option value="{{$Fornecedor->id}}"
                        {{ $Fornecedor->id == $id_fornecedor ? 'selected' : '' }}> 
                        {{$Fornecedor->nome_fantasia}}</option>
                    @endforeach
                    @else
                    No records
                    @endif

                   
                                            
                </select>
                                                                                 
            </div>
            
            <div>
            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
            <a href="{{ route('processo.index') }}" class="btn btn-warning mb-2">Limpar</a>
            </div>
        </form>





        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table hover">
            <thead class="table-primary">
                <tr>
                    <th >#</th>
                    <th>Processo</th>
                    <th>Descrição</th>
                    <th>Fornecedor</th>
                    <th>Número da O.F</th>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Valor do item</th>
                    <th class="text-center">Ação</th>
                    

                </tr>
            </thead>

            <tbody>
                @if ($Processo->count() > 0)
                    @foreach ($Processo as $rs)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $rs->numero }}</td>
                            <td class = "align-middle">{{ $rs->descricao }}</td>
                            <td class = "align-middle">{{ $rs->Fornecedores->nome_fantasia  }}</td>
                            <td class = "align-middle">{{ $rs->numero_of }}</td>
                            <td class = "align-middle">{{ $rs->item }}</td>
                            <td class = "align-middle">{{ $rs->quantidade }}</td>
                            <td class = "align-middle">{{ Number::format($rs->valor,locale: 'pt_BR') }} R$</td>
                           


                            <td class = "align-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('processo.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('processo.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#mediumModal-{{$rs->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        @include('processo.MediumModal')
                                </div>
                            </td>
                          
                        </tr>
                    @endforeach

                @else
                    <tr>                     
                        <td colspan="9" style="text-align: center">Não existem processos cadastrados</td>
                    </tr>
                @endif
                @if(isset($nome) OR ($descricao) OR ($item))
                <table class="table hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-center" >Totais:</th>
                                                       
                           
                            <th class="align-center">Items do processo: {{$NumeroItem}}</th>                             
                            <th class="align-center">Quantidade de produtos:{{$valorquantidade}}</th>                           
                            @if(isset ($item) )
                            <th class="align-center">Quantidade total do item pesquisado:{{$quantidade_total_item_nas_ordens}}
                            @endif
                            <th class="align-center">Custo total do processo. {{  Number::format($total_processo,locale: 'pt_BR')}} R$</th>
                            @if(isset ($id_fornecedor) )
                            <th class="align-center">Somatório das O.F do fornecedor selecionado. {{  Number::format($valorempenhado,locale: 'pt_BR')}} R$</th>
                            @endif
                            @if(isset ($numero_of) )
                            <th class="align-center">Total da O.F selecionada {{ Number::format($total_ordem,locale: 'pt_BR')}} R$</th>
                            @endif
                            <th></th>
                       </tr>
                   </thead>
                </table>
                @endif
            </tbody>
        </table>
        <div class="d-flex">      
            Total de itens: {!! $Processo->total() !!}
        </div>       
        <div class="d-flex">
           
            Página atual: {!! $Processo->currentPage() !!}
        </div>
        <div class="d-flex">
            {!! $Processo->links() !!}
           
        </div>

    </div>

    <script>
   
        $('select').select2({
        theme: 'bootstrap4',
    });
</script>



@endsection
