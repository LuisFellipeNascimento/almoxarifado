@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Saidas por Material.</h1>
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
            <a href="{{ url('pedidos.inventario?' . request()->getQueryString()) }}" class="btn btn-danger">Exportar</a>
        </div>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Materiais</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <select name="id_produtos" id="select" class="form-control select" style="width:450px;">
                    @if ($Materiais->count() > 0)
                        <option value="" disabled selected>Selecione um produto.</option>
                        @foreach ($Materiais as $Materiai)
                            <option value="{{ $Materiai->id }}">{{ $Materiai->nome_produto }}</option>
                        @endforeach
                    @else
                        No records
                    @endif

                </select>
               

            </div>

            <div>
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('pedidos.saida_produto') }}" class="btn btn-warning mb-2">Limpar</a>
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
                        <th>Setor/Departamento</th>
                        <th>Unidade</th>
                        <th>Data da entrega</th>



                    </tr>
                </thead>
            <tbody>
                @foreach ($saidas as $saida)
                    <tr>

                        <td>{{ $saida->Produto->nome_produto }}</td>
                        <td>{{ $saida->Unidades->nome_unidade }}</td>
                        <td>{{ $saida->quantidade }}</td>
                        <td>{{ $saida->created_at->format('d/m/Y H:i:s') }} </td>


                    </tr>
                @endforeach
            </tbody>


        </table>
        @if (isset($id_produtos))
            <div>
                <b>Total de saidas: {{ $totalValor }}</b>
            </div>
        @endif

        <div class="d-flex">
            {!! $saidas->appends(request()->query())->links() !!}

        </div>

        <script>
            $('select').select2({
                theme: 'bootstrap4',
            });
        </script>

    @endsection
