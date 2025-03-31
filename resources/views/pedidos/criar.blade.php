@extends('web.home')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar Saida de Material123</h1>
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


        <form action="{{ route('pedidos.store') }}" method="POST" id="form-id">

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
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="width:35%">Unidade</th>
                        <th scope="col" style="width:35%">Material</th>
                        <th scope="col" style="width:10%">Saldo</th>
                        <th scope="col" style="width:10%">Quantidade</th>
                        <th scope="col" style="width:10%">Número do pedido</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="inputs[0][id_unidades]" id="select1" class="form-control select2" required>
                                @if ($unidades->count() > 0)
                                    <option value="" disabled selected>Selecione uma unidade</option>
                                    @foreach ($unidades as $unidade)
                                        <option value="{{ $unidade->id }}">{{ $unidade->nome_unidade }}</option>
                                    @endforeach
                                @else
                                    No records
                                @endif
                            </select>

                        </td>


                        <td>
                            <select name="inputs[0][id_produtos]" id="select2" class="form-control select2" required>
                                @if ($Produto->count() > 0)
                                    <option value="" disabled selected>Selecione um produto.</option>
                                    @foreach ($Produto as $Mostra)
                                        <option value="{{ $Mostra->id }}">{{ $Mostra->nome_produto }}</option>
                                    @endforeach
                                @else
                                    No records
                                @endif

                            </select>
                        </td>
                        <td><input type="number" step=".01" class= "form-control" name="saldos"
                            value ="{{$saidas->saldo_atual}}"></td>

                        <td><input type="number" step=".01" class= "form-control" name="inputs[0][quantidade]"
                            required></td>

                        <td><input type="text" class="form-control" name="inputs[0][codigo_pedido]"  id="codigo_pedido"
                                placeholder="Número do pedido" required></td>


    </div>

    <td><button type="button" class= "btn btn-success" name="add" id="add">Add</button></td>

    </tr>

    </tbody>
    </table>

    <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>


    </form>

    </div>


<script>
   
    $('select').select2({
    theme: 'bootstrap4',
});
</script>


<script>
     var unidades = @json($unidades);
    var produtos = @json($Produto);
    var i = 0;
    
    $('#add').click(function() {
        ++i;
        
        // Criando as opções dinamicamente
        var unidadeOptions = ['<option value="">Selecione uma unidade</option>'];
        unidades.forEach(function(unidade) {
            unidadeOptions.push(`<option value="${unidade.id}">${unidade.nome_unidade}</option>`);
        });
        
        var produtoOptions = ['<option value="">Selecione um produto</option>'];
        produtos.forEach(function(produto) {
            produtoOptions.push(`<option value="${produto.id}">${produto.nome_produto}</option>`);
        });

        var codigoPedidoValue = $('#codigo_pedido').val(); // Pegando o valor atual do campo código do pedido
        var codigoUnidadeValue = $('#select1').val(); // Pegando o valor atual do campo unidade
        
        var newRow = `
            <tr>
                <td>
                    <select name="inputs[${i}][id_unidades]" class="form-control select2-dynamic"  value="${codigoUnidadeValue}" required>
                        ${unidadeOptions.join('')}
                    </select>
                </td>
                <td>
                    <select name="inputs[${i}][id_produtos]" class="form-control select2-dynamic">
                        ${produtoOptions.join('')}
                    </select>
                </td>
                <td>
                    <input type="number" name="inputs[${i}][quantidade]" class="form-control" step=".01"  >
                </td>
                <td>
                    <input type="text" name="inputs[${i}][codigo_pedido]" class="form-control"  value="${codigoPedidoValue}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-tr">Remover</button>
                </td>
            </tr>
        `;
        
        $('#table tbody').append(newRow);

            // Remove a linha
        $(document).on('click', '.remove-tr', function() {
            $(this).closest('tr').remove();
        });
        
        // Inicializa os novos selects
        $('select.select2-dynamic').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
        $('#codigo_pedido').on('change', function() { var newValue = $(this).val(); $('.codigo_pedido').val(newValue); });
    });
</script>



@endsection
