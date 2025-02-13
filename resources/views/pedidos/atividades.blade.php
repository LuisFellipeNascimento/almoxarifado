@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Histórico de Modificações</h1>
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
            <a href="{{ url('#' . request()->getQueryString()) }}" class="btn btn-danger">Exportar</a>
        </div>
        <form class="form-inline">           
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>

                <select name="nome_do_usuario" id="select3" class="form-control" style="width:10%">

                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}" {{ $autor->id == $nome_do_usuario ? 'selected' : '' }}>
                            {{ $autor->name }}</option>
                    @endforeach
                    
                </select>

            </div>

            <div>
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('pedidos.atividades') }}" class="btn btn-warning mb-2">Limpar</a>
            </div>
        </form>





        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table id="example" class="table table-striped table-bordered" style="width:100%">

            <thead class="table hover">
                <tr>
                    <th class="text-center" style="width:1%">#</th>
                    <th class="text-center" style="width:39%">Usuário</th>
                    <th class="text-center" style="width:5%">Evento</th>
                    <th class="text-center" style="width:5%">Tabela</th>
                    <th class="text-center" style="width:20%">Alteração</th>
                    <th class="text-center" style="width:25%">Dado Antigo</th>
                    <th class="text-center" style="width:5%">Data da Criação</th>
                    <th class="text-center" style="width:5%">Data da Atualização</th>

                </tr>
            </thead>

            <tbody>
                @if ($auditorias->count() > 0)
                    @foreach ($auditorias as $auditoria)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $auditoria->user->name ?? 'Desconhecido' }}</td>

                            <td class = "align-middle">
                                @switch($auditoria->event)
                                    @case('created')
                                        Criação
                                    @break
                                    @case('updated')
                                        Atualização
                                    @break
                                    @case('deleted')
                                        Exclusão
                                    @break
                                     @case('restored')
                                        Restauração
                                    @break
                                @endswitch
                            </td>

                            <td>
                                {{ Str::of($auditoria->auditable_type)->afterLast('\\')->plural()->snake() }}
                            </td>
                            <td class = "align-middle">
                                <pre>{{ json_encode($auditoria->new_values, JSON_PRETTY_PRINT) }}</pre>
                            </td>
                            <td class = "align-middle">
                                <pre>{{ json_encode($auditoria->old_values, JSON_PRETTY_PRINT) }}</pre>
                            </td>
                            <td class = "align-middle">{{ $auditoria->created_at }}</td>
                            <td class = "align-middle">{{ $auditoria->updated_at }}</td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center">Não existem alterações dos usuários.</td>
                    </tr>
                @endif

            </tbody>
        </table>
        <div class="d-flex">
            {!! $auditorias->links() !!}

        </div>

    </div>

   


    <script>
        $('select').select2({
            theme: 'bootstrap4',
        });
    </script>


@endsection
