@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de unidades</h1>
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
            <a href="{{ route('unidades.create') }}" class="btn btn-success">Adicionar Unidade</a>
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Nome da unidade</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="valor" name="codigo" placeholder="Código"
                    value="{{ $codigo }}">
                <input type="text" class="form-control" id="nome_fantasia" name="nome" placeholder="Nome"
                    value="{{ $nome }}">
            </div>

            <div>
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('unidades.index') }}" class="btn btn-warning mb-2">Limpar</a>
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
                    <th>Código</th>
                    <th>Nome</th>
                    <th class="text-center" colspan="3">Ação</th>
                </tr>
            </thead>

            <tbody>
                @if ($unidades->count() > 0)
                    @foreach ($unidades as $rs)
                        <tr>
                            <td class = "align-middle">{{ $rs->id }}</td>
                            <td class = "align-middle">{{ $rs->nome }}</td>
                            <td class = "btn-group">
                                <div class="btn-group" role="group" aria-label="Basic example">


                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#show-{{ $rs->id }}">
                                        Detalhes
                                    </button>

                                    @include('unidades.show')
                                </div>
                            </td>
                            <td class = "btn-group"><a href="{{ route('unidades.edit', $rs->id) }}" type="button"
                                    class="btn btn-warning">Editar</a></td>
                            <td class = "btn-group">
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <button type="button" class="btn btn-danger " data-toggle="modal"
                                        data-target="#mediumModal-{{ $rs->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    @include('unidades.MediumModal')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Não existe unidades</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $unidades->links() !!}

        </div>
    
    </div>

  

@endsection
