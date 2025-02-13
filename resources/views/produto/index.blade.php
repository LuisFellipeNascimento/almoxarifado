@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de Materiais Cadastrados</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Materiais</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="float-right">
            <a href="{{ route('produto.create') }}" class="btn btn-success">Adicionar Material</a>


        </div>
        <form action="{{ route('produto.import') }}" method="POST" enctype="multipart/form-data">Importar Inventário
            @csrf
            <div class="form-group">
                <label for="file">Selecionar Arquivo</label>
                <input type="file" name="excel_file" id="file" accept=".xlsx,.xls,.csv" class="form-control-file"
                    required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i>Importar
            </button>
        </form>
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Material</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Material" style="width:150px;"
                    value="{{ $nome }}">
                    <input type="text" class="form-control" id="codigobarras" name="codigobarras" placeholder="Código Antigo" style="width:150px;"
                    value="{{ $codigobarras }}">
                <select name="vencimento" id="vencimento" class="form-control" value="{{ $vencimento }}" style="width:150px;">
                    <option value="" disabled selected>Validade</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                </select>
                <select name="id_categoria" id="id_categoria" class="form-control" style="width: 300px;">
                    @if ($Categorias->count() > 0)
                        <option value="" disabled selected {{ old('id_categoria', $selectedCategoryId ?? '') === null ? 'selected' : '' }}>Selecione uma categoria.</option>
                        @foreach ($Categorias as $Categoria)
                            <option value="{{ $Categoria->id }}" {{ (old('id_categoria') == $Categoria->id || (isset($selectedCategoryId) && $selectedCategoryId == $Categoria->id)) ? 'selected' : '' }}>
                                {{ $Categoria->nome_categoria }}
                            </option>
                        @endforeach
                    @else
                        Não existem categorias cadastradas.
                    @endif
                </select>
                


                <input type="text" class="form-control" id="local" name="local" placeholder="Reta,Patrimônio" style="width:150px;"
                    value="{{ $local }}">

            </div>

            <div>
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('produto.index') }}" class="btn btn-warning mb-2">Limpar</a>
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

                    
                    <th class="text-center">Código Antigo</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Vencimento</th>
                    <th class="text-left">Local de armazenamento</th>
                    <th class="text-left">Quantidade</th>
                    <th class="text-center">Foto</th>

                    <th class="text-center" colspan="3">Ação</th>


                </tr>
            </thead>

            <tbody>
                @if ($produto->count() > 0)
                    @foreach ($produto as $rs)
                        <tr>
                            
                            <td class = "align-middle">{{ $rs->codigobarras }}</td> 
                            <td class = "align-middle">{{ $rs->nome_produto }}</td>
                            <td class = "align-middle">
                                @if ($rs->vencimento == '1970-01-01')
                                    <p>Indeterminada</p>
                                @else
                                    {{ Carbon\Carbon::parse($rs->vencimento)->format('d/m/Y') }}
                            </td>
                    @endif
                    </td>
                    <td class = "align-middle">{{ $rs->local }}</td>
                    <td class = "align-middle">{{ $rs->quant_total }}</td>
                    <td class = "align-middle"><a href="{{ asset($rs->foto) }}" data-fancybox
                            data-caption="{{ $rs->nome_produto }}"><img src="{{ asset($rs->foto) }}"
                                style="width: 70px; height: 70px;" alt="img" /></td>
                    <td class = "align-center">
                        <div class="btn-group" role="group" aria-label="Basic example">


                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#show-{{ $rs->id }}">
                                Detalhes

                            </button>
                            @include('produto.show')


                        </div>

                    </td>
                    <td class = "align-center">
                        <a href="{{ route('produto.edit', $rs->id) }}" type="button" class="btn btn-info">Editar</a>
                    </td>
                    <td class = "align-center">

                        <button type="button" class="btn btn-danger " data-toggle="modal"
                            data-target="#mediumModal-{{ $rs->id }}">
                            <i class="bi bi-trash"></i>
                        </button>

                        @include('produto.MediumModal')

                    </td>






                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Não existe resultado para essa busca.</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $produto->links() !!}
        </div>

    </div>

    <script>
         
   
   $('select').select2({
   theme: 'bootstrap4',
});

    </script>

@endsection
