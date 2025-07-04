@extends('web.home')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar C.I</h1>
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


        <form action="{{ route('gerenciarci.store') }}" method="POST" id="form-id">

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
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Número da Comunicação Interna (C.I)</label>
                    <input type="text" class="form-control" name="numero_ci" >
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Unidade escolar</label>
                    <select name="id_unidades" id="id_unidades" class="form-control select2" required>
                        @if ($unidades->count() > 0)
                            <option value="" disabled selected>Selecione uma unidade</option>
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}">{{ $unidade->nome_unidade }}</option>
                            @endforeach
                        @else
                            No records
                        @endif
                    </select>   
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Status</label><br>
                <select id="inputState" class="form-control" name="status">
                    <option value="NÃO ATENDIDA" selected>NÃO ATENDIDA</option>
                    <option value="ATENDIDA">ATENDIDA</option>
                    <option value="PARCIALMENTE ATENDIDA">PARCIALMENTE ATENDIDA</option>
                    <option value="CANCELADA">CANCELADA</option>
                    <option value="RESPONDIDA">RESPONDIDA</option>

                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="inputAddress">Detalhes do pedido</label>
                <textarea class="form-control" id="inputAddress" name="descricao" ></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputCity">Data do recebimento</label>
                    <input type="date" class="form-control" id="inputCity" name="recebimento_ci">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Data do atendimento</label>
                    <input type="date" class="form-control" id="inputCity" name="atendimento_ci">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Data da Resposta</label>
                    <input type="date" class="form-control" id="inputCity" name="data_resposta">
                </div>
             
            </div>

            <button type="submit" class="btn btn-primary">Casdastrar</button>
        </form>
       

    </div>


  
   






    <script>
        $('select').select2({
            theme: 'bootstrap4',
        });
    </script>


@endsection
