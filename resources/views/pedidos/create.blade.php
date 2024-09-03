@extends('web.home')

@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar Saida de Material</h1>
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
                        <th scope="col" style="width:40%">Unidade</th>
                        <th scope="col" style="width:40%">Material</th>
                        <th scope="col" style="width:10%">Quantidade</th>
                        <th scope="col" style="width:10%">Número do pedido</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="inputs[0][id_unidades]" id="select1" class="select3 form-control">
                                @if ($unidades->count() > 0)
                                    <option value="" disabled selected>Selecione uma unidade</option>
                                    @foreach ($unidades as $unidade)
                                        <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                                    @endforeach
                                @else
                                    No records
                                @endif
                            </select>

                        </td>


                        <td>
                            <select name="inputs[0][id_produtos]" id="select3" class="select3 form-control">
                                @if ($Produtos->count() > 0)
                                    <option value="" disabled selected>Selecione um produto.</option>
                                    @foreach ($Produtos as $Produto)
                                        <option value="{{ $Produto->id }}">{{ $Produto->nome }}</option>
                                    @endforeach
                                @else
                                    No records
                                @endif

                            </select>
                        </td>


                        <td><input type="number" step=".01" class= "form-control" name="inputs[0][quantidade]"
                                placeholder="10.000,00"></td>

                        <td><input type="text" name="inputs[0][codigo_pedido]" id="teste" class="form-control"
                                placeholder="Número do pedido"></td>


    </div>

    <td><button type="button" class= "btn btn-success" name="add" id="add">Add</button></td>

    </tr>

    </tbody>
    </table>

    <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>


    </form>

    </div>


    <script>
        var i = 0;
        $('#add').click(function() {


            ++i;

            $('#table').append(

                `<tr>
                       <td>              
                       <select name="inputs[` + i + `][id_unidades]"  id="select10" class="select3 form-control" >
                            @if ($unidades->count() > 0)
                            <option value="" disabled selected>Selecione uma unidade</option>
                            @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                            @endforeach
                            @else
                            No records
                            @endif
                        </select>
                          </td> 
  
                        
                        <td>
                            <select name="inputs[` + i + `][id_produtos]"  id="select2" class="select3 form-control">
                                        @if ($Produtos->count() > 0)
                                        <option value="" disabled selected>Selecione um produto</option>
                                        @foreach ($Produtos as $Produto)
                                        <option value="{{ $Produto->id }}">{{ $Produto->nome }}</option>
                                        @endforeach
                                        @else
                                        No records
                                        @endif
                            
                            </select>                           
                         </td>
                       
                        <td>                 
                            <input type="number" step=".01"  class= "form-control"  name="inputs[` + i + `][quantidade]"  id="debit-transaction-edit" placeholder="10.000,00" ></td>
                       <td> <input type="text" class= "form-control" name="inputs[` + i + `][codigo_pedido] id="select122"
                       placeholder="Número do pedido"> </td> 

                            <td><button type="button" class= "btn btn-danger remove-table-row">Remover</button></td>
                            
                     
                
            </tr> `);

            //adicionando mascara no formulário

            $('select').select2({
                theme: 'bootstrap4',
            });

        });
        $(document).on('click', '.remove-table-row', function() {


            $(this).parents('tr').remove();


        });
    </script>

    <script>
        $('select').select2({
            theme: 'bootstrap4',
        });
    </script>


@endsection
