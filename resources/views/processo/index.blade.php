@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de Processos Cadastradas</h1>
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
        <div class="float-right">
            <a href="{{ route('processo.create') }}" class="btn btn-success">Adicionar Processos</a>            
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Processo</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Número do processo" value="{{$nome}}">           
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{$descricao}}">
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor total" value="{{$valor}}">
                                                                                 
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
                    <th>#</th>
                    <th>Processo</th>
                    <th>Descrição</th>
                    <th>Valor total</th>
                    <th>Ação</th>

                </tr>
            </thead>

            <tbody>
                @if ($Processo->count() > 0)
                    @foreach ($Processo as $rs)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $rs->numero }}</td>
                            <td class = "align-middle">{{ $rs->descricao }}</td>
                            <td class = "align-middle">{{ Number::format($rs->valor,locale: 'pt_BR') }} R$</td>
                           


                            <td class = "align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('processo.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('processo.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                    <form action="{{ route('processo.destroy', $rs->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0" type="submit">Apagar</button>

                                    </form>
                                </div>
                            </td>
                            <td>{{$valorempenhado}}</td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Não existem processos cadastrados</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $Processo->links() !!}
        </div>

    </div>



@endsection
