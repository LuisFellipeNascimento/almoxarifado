@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar Processo</h1>
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
        <form action="{{ route('processo.store') }}" method="POST" id="form-id">
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

                        <th scope="col">Número do processo</th>
                        <th scope="col">Descricão</th>
                        <th scope="col">Valor total</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td> <input type="text" class= "form-control" name="inputs[0][numero]" 
                                placeholder="Número do processo"></td>
                        <td><input type="text" class= "form-control" name="inputs[0][descricao]" 
                                placeholder="Diga o objetivo do material a ser adquirido"></td>
                        <td>
                          
                                <input type="text" class="form-control  money" name="inputs[0][valor]" id="valor"
                                    placeholder="10.000,00">
                        </td>
    </div>
    <td><button type="button" class= "btn btn-success  money" name="add" id="add">Add</button></td>

    </tr>

    </tbody>
    </table>

    <button type="submit">Cadastrar</button>


    </form>

    </div>

    <script>
        var i = 0;
        $('#add').click(function() {


            ++i;
            $('#table').append(

                `<tr>

                        <td> <input type="text" name="inputs[`+i+`][numero]"  class= "form-control"   placeholder="Número do processo" ></td>
                        <td><input type="text"  name="inputs[`+i+`][descricao]"  class= "form-control"   placeholder="Diga o objetivo do material a ser adquirido"   ></td>
                        <td>                 
                            <input type="text"  class= "form-control money"  name="inputs[`+i+`][valor]"  id="debit-transaction-edit" placeholder="10.000,00" ></td>
                       
                            <td><button type="button" class= "btn btn-danger remove-table-row">Remover</button></td>
                
            </tr> `);
            //adicionando mascara no formulário
            $('.money').maskMoney({
                allowNegative: true,
                thousands: '.',
                decimal: ',',
                affixesStay: true,
            });
            var table = $(".debit-transaction-edit");
        });
        $(document).on('click', '.remove-table-row', function() {






            $(this).parents('tr').remove();


        });
    </script>
    <script>
        $(document).ready(function() {
            $('.money').maskMoney({
                allowNegative: true,
                thousands: '.',
                decimal: ',',
                affixesStay: true,
            });

        })
    </script>
{{--  removendo mascara moeda --}}
<script>
   $("#form-id").submit(function(){
    var value = $('#valor').maskMoney('unmasked')[0];
    $('#valor').val(value);
  });
</script>
{{-- removendo mascara moeda --}}
<script>
    $("#form-id").submit(function(){
     var value = $('#debit-transaction-edit').maskMoney('unmasked')[0];
     $('#debit-transaction-edit').val(value);
   });

   function setMask() {
	$('.money').mask('#.##0,00', {
		reverse: true,
		maxlength: false
	});
}
 </script>
 

@endsection
