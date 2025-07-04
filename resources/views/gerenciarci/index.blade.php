@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Controle de Comunicação Interna (C.I)</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"><a href="{{ route('gerenciarci.create') }}" class="btn btn-success"><i
                                    class="fa ti-shopping-cart"></i> Cadastrar C.I</a>
                            <a href="{{ route('gerenciarci.show',request()->all()) }}" class="btn btn-danger"><i
                                    class="fa fa-file"></i> Exportar</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <form method ="GET" action="{{ route('gerenciarci.index') }}">
            @csrf
            <div class="form-row">
                <label class="sr-only" for="inlineFormInputGroupUsername2">C.I's</label>
                

                    <div class="col-md-3">
                        <div class="input-group-prepend">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Número da C.I</div>
                            </div>
                            <input type="text" class="form-control" id="numero_ci" name="numero_ci"
                                placeholder="Número da C.I" value="{{ $numero_ci }}">
                        </div>
                    </div>
               
                <div class="col-md-6">
                    <div class="input-group-prepend">

                        <div class="input-group-prepend">
                            <div class="input-group-text">Solicitante</div>
                        </div>
                        <select name="id_unidades" id="select3" class="form-control">
                            @if ($unidades->count() > 0)
                                <option value="" selected>Selecione uma unidade</option>
                                @foreach ($unidades as $unidade)
                                    <option value="{{ $unidade->id }}"
                                        {{ $unidade->id == $id_unidades ? 'selected' : '' }}>
                                        {{ $unidade->nome_unidade }}</option>
                                @endforeach
                            @else
                                No records
                            @endif



                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group-prepend">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Detalhes do pedido</div>
                        </div>
                        <input type="text" class="form-control" id="descricao" name="descricao"
                            placeholder="Detalhes do pedido" value="{{ $descricao }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group-prepend">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Status</div>
                        </div>
                        <select id="status" class="form-control" name="status" required>
                            <option value="" {{ old('status', $status) == '' ? 'selected' : '' }}></option>
                            <option value="NÃO ATENDIDA" {{ old('status', $status) == 'NÃO ATENDIDA' ? 'selected' : '' }}>NÃO ATENDIDA</option>
                            <option value="ATENDIDA" {{ old('status', $status) == 'ATENDIDA' ? 'selected' : '' }}>ATENDIDA</option>
                            <option value="PARCIALMENTE ATENDIDA" {{ old('status', $status) == 'PARCIALMENTE ATENDIDA' ? 'selected' : '' }}>PARCIALMENTE ATENDIDA</option>
                            <option value="CANCELADA" {{ old('status', $status) == 'CANCELADA' ? 'selected' : '' }}>CANCELADA</option>
                            <option value="RESPONDIDA" {{ old('status', $status) == 'RESPONDIDA' ? 'selected' : '' }}>RESPONDIDA</option>
                        </select>
                    </div>
                </div>


                <div class="col-auto">
                    <div class="input-group-prepend">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período inicial de atendimento</div>
                        </div>
                        <input type="date" class="form-control" id="data_inicial_atendimento"
                            name="data_inicial_atendimento" value="{{ $data_inicial_atendimento }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período final de atendimento</div>
                        </div>
                        <input type="date" class="form-control" id="data_final_atendimento"
                            name="data_final_atendimento" value="{{ $data_final_atendimento }}">
                    </div>
                </div>



                <div class="col-auto">
                    <div class="input-group-prepend">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período inicial recebimento</div>
                        </div>
                        <input type="date" class="form-control" id="recebimento_ci" name="data_inicial_recebimento"
                            value="{{ $data_inicial_recebimento }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período final de recebimento</div>
                        </div>
                        <input type="date" class="form-control" id="data_final_recebimento" name="data_final_recebimento"
                            value="{{ $data_final_recebimento }}">
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group-prepend">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período inicial de resposta</div>
                        </div>
                        <input type="date" class="form-control" id="data_inicial_resposta"
                            name="data_inicial_resposta" value="{{ $data_inicial_resposta }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período final de resposta</div>
                        </div>
                        <input type="date" class="form-control" id="data_final_resposta" name="data_final_resposta"
                            value="{{ $data_final_resposta }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('gerenciarci.index') }}" class="btn btn-warning mb-2">Limpar</a>
            </div>
          
        </form>





        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table id="example" class="table table-striped table-bordered" style="width:100%">

            <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:5%">Número da C.I</th>
                    <th style="width:40%">Solicitante</th>
                    <th style="width:40%">Descrição do pedido</th>
                    <th style="width:40%">Status</th>
                    <th style="width:5%">Data do recebimento</th>                    
                    <th style="width:5%">Data da resposta</th>
                    <th style="width:5%">Atendida em</th>
                    <th class="text-center" style="width:5%">Ação</th>


                </tr>
            </thead>

            <tbody>
                @if ($controle_ci->count() > 0)
                    @foreach ($controle_ci as $rs)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $rs->numero_ci }}</td>
                            <td class = "align-middle">{{ $rs->unidades->nome_unidade }}</td>
                            <td class = "align-middle">{{ $rs->descricao }}</td>
                            <td class = "align-middle">{{ $rs->status }}</td>
                            <td class = "align-middle">{{\Carbon\Carbon::parse ($rs->recebimento_ci)->format('d/m/Y') }}</td>                            
                            <td class = "align-middle">{{$rs->data_resposta ? \Carbon\Carbon::parse ($rs->data_resposta) ->format('d/m/Y') : 'Não respondida'}}</td>
                            <td class = "align-middle">{{$rs->atendimento_ci ? \Carbon\Carbon::parse ($rs->atendimento_ci)->format('d/m/Y') : 'Não atendida' }}</td>
                         
                            
                            </td>
                            
                            <td class = "align-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    
                                    <a href="{{ route('gerenciarci.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                    <button type="button" class="btn btn-danger " data-toggle="modal"
                                        data-target="#mediumModal-{{ $rs->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    @include('gerenciarci.MediumModal')
                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center">Não existem C.I com esse filtro.</td>
                    </tr>
                @endif

            </tbody>
        </table>
        <div class="d-flex">
            Total de itens: {!! $controle_ci->total() !!}
        </div>
        <div class="d-flex">

            Página atual: {!! $controle_ci->currentPage() !!}
        </div>
        <div class="d-flex">
            {!! $controle_ci->links() !!}

        </div>

    </div>

    <script>
        $('select').select2({
            theme: 'bootstrap4',
        });
    </script>

@endsection
