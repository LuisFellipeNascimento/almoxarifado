@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Lista de Ordens Cadastradas</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">
                            <div class="float-right"><a href="{{ route('ordem.create') }}" class="btn btn-success">Adicionar
                                    Ordem</a>
                                    <button id="btnExport" class="btn btn-success">Exportar para Excel</button>      
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">


        <form method ="GET" action="{{ route('ordem.index') }}">
            @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="id_processo" class="control-label mb-1">Processo</label>
                    <select name="id_processo[]" multiple="multiple" id="id_processo" class="select4 form-control"
                        style="width: 100%" required>

                        @foreach ($Processos as $process)
                            <option value="{{ $process->id }}"
                                @if (in_array($process->id, $id_processo ?? [])) selected="selected" @endif>
                                {{ $process?->numero }}</option>
                        @endforeach

                    </select>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_fornecedor" class="control-label mb-1"> Fornecedor</label><br>

                    <select name="id_fornecedor" id="select3" class="select2 form-control cc-exp">

                        @foreach ($Fornecedores as $Fornecedor)
                            <option value="">Ver todos os fornecedores envolvidos.</option>
                            <option value="{{ $Fornecedor->id }}" {{ $Fornecedor->id == $id_fornecedor ? 'selected' : '' }}>
                                {{ $Fornecedor->nome_fantasia }}</option>
                        @endforeach
                    </select>

                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="descricao" class="control-label mb-1">Descrição</label><br>
                    <select name="id_produtos" id="select13" class="select2 form-control cc-exp">

                        @foreach ($Produtos as $Produto)
                            <option value="">Ver todos os Produtoes envolvidos.</option>
                            <option value="{{ $Produto->id }}" {{ $Produto->id == $id_produtos ? 'selected' : '' }}>
                                {{ $Produto->nome_produto }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 mb-3">
                    <label for="item" class="control-label mb-1">Item</label><br>
                    <select name="item" id="select4" class="select2 form-control cc-exp">

                        @foreach ($ordem->unique('item') as $process4)
                            <option value="">Item</option>
                            <option value="{{ $process4->item }}" {{ $process4->item == $item ? 'selected' : '' }}>
                                {{  $process4?->item }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-1 mb-3">
                    <label for="empenho" class="control-label mb-1">Empenho</label><br>
                    <select name="empenho" id="select5" class="select2 form-control cc-exp">
                        @foreach ($ordem->unique('empenho') as $empenho1)
                            <option value="">empenho</option>
                            <option value="{{ $empenho1->empenho }}"
                                {{ $empenho1->empenho == $empenho ? 'selected' : '' }}>
                                {{ $empenho1?->empenho }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="numero_ordem" class="control-label mb-1">Número da ordem</label><br>
                    <select name="numero_ordem" id="select7" class="select2 form-control cc-exp">
                        @foreach ($ordem->unique('numero_ordem') as $numero_ordem1)
                            <option value="">numero_ordem</option>
                            <option value="{{ $numero_ordem1->numero_ordem }}"
                                {{ $numero_ordem1->numero_ordem == $numero_ordem ? 'selected' : '' }}>
                                {{ $numero_ordem1?->numero_ordem }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="nota_fiscal" class="control-label mb-1">Número da Nota fiscal</label><br>
                    <input type="text" name="nota_fiscal" class="form-control form-control-sm" value="{{$nota_fiscal}}">
                </div>

                <div class="col-md-2 mb-2">
                    <label for="data_inicial" class="control-label mb-1">Inicio do recebimento</label><br>
                    <input type="date" name="data_inicial" class="form-control form-control-sm" value="{{$data_inicial}}">
                </div>    
                <div class="col-md-2 mb-2">
                    <label for="data_inicial" class="control-label mb-1">Fim do recebimento</label><br>    
                    <input type="date" name="data_final" class="form-control form-control-sm" value="{{$data_final}}">
                </div>

            </div>

            <button type="submit" class="btn btn-primary "><i class="fa fa-search"></i> Procurar</button>


            <a href="{{ route('ordem.index') }}" class="btn btn-warning"><i class="bi bi-magic"></i> Limpar</a>


        </form>
        <br>

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="table hover" id="divTabela">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Processo</th>
                    <th>Fornecedor</th>
                    <th>Ordem</th>
                    <th>Empenho</th>
                    <th>Item</th>
                    <th>Descrição</th>
                    <th>Nota Fiscal</th>
                    <th>Data de entrega do Fornecedor</th>
                    <th>Quantidade</th>
                    <th> Valor Total</th>
                    <th class="text-center">Ação</th>

                </tr>
            </thead>

            <tbody>
                @if ($ordem->count() > 0)
                    @foreach ($ordem as $rs)
                        <tr>
                            <td class = "align-middle">{{ $loop->iteration }}</td>
                            <td class = "align-middle">{{ $rs->Processo->numero }}</td>
                            <td class = "align-middle">{{ $rs->Fornecedores->nome_fantasia }}</td>
                            <td class = "align-middle">{{ $rs->numero_ordem }}</td>
                            <td class = "align-middle">{{ $rs->empenho }}</td>
                            <td class = "align-middle">{{ $rs->item }}</td>
                            <td class = "align-middle">{{ $rs->Produto->nome_produto }}</td>
                            <td class = "align-middle">{{ $rs->nota_fiscal }}</td>
                            <td class = "align-middle">{{Carbon\Carbon::parse($rs->data_entrega)->format('d/m/Y')}}</td>
                            <td class = "align-middle">{{ $rs->quant_total }}</td>
                            <td class = "align-middle"> {{ Number::format($rs->valor_total, locale: 'pt_BR') }} R$</td>



                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('ordem.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('ordem.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>


                                    <button type="button" class="btn btn-danger " data-toggle="modal"
                                        data-target="#mediumModal-{{ $rs->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    @include('ordem.MediumModal')




                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" style="text-align: center">Não existe ordens cadastradas nesse processo.</td>
                    </tr>
                @endif
                @if (isset($id_processo) and isset($numero_ordem))
                    @if ($resultado_of == 0)
                        <div class="alert alert-success" role="alert">A ordem foi cumprida na sua totalidade.</div>
                    @elseif($resultado_of > 0)
                        <div class="alert alert-warning" role="alert">Existe
                            {{ Number::format($resultado, locale: 'pt_BR') }} R$ de saldo disponíveis a serem pedidos!
                        </div>
                    @elseif($resultado_of < 0)
                        <div class="alert alert-danger" role="alert">Você recebeu
                            {{ Number::format($resultado, locale: 'pt_BR') }} R$ a mais de material que deveria, contate o departamento
                            de compras!</div>
                    @endif
                @endif

                @if (isset($id_processo))
                    <tr>
                        <thead class="table-primary">
                            <tr>
                                <th colspan="12">Valor total das notas fiscais desse processo. </th>



                            </tr>
                        </thead>

            <tbody>
                <td  colspan="11" class="text-right">
                    {{ Number::format($total_produtos, locale: 'pt_BR') }} R$
                </td>

                </tr>
            </tbody>

            <thead class="table-primary">
                <tr>
                    <th>Saldo disponível nas O.F.s </th>                   
                    <th>Quantidade geral de produtos a receber </th>
                    <th>Quantidade total empenhada até o momento do produto </th>
                    @if (isset($item))
                    <th>Quantidade de itens a receber</th>
                    @endif  
                    <th>Quantidade total de produtos recebidos</th>
                    <th>Total da ordem de fornecimento</th>
                    <th>Status da ordem</th>
                    
                </tr>
            </thead>
            <tbody>
                @if (isset($id_fornecedor) or (isset($numero_ordem) or (isset($item)) ))
                    <tr>
                        <td> R${{ Number::format($resultado, locale: 'pt_BR') }}</td>                       
                        <td>{{ $resultado_confronto }}</td>
                        <td>{{ $quantidade_total_item_no_processo}}</td>
                        @if (isset($item))
                        <td> 
                            @if($quantidade_total_item<0)
                        Você precisa devolver {{$quantidade_total_item}} desse item.
                           @else  {{$quantidade_total_item}} 
                        @endif
                        
                        </td>
                        @endif 
                        <td>{{ $resultado_quantidade }}</td>
                        <td>R${{ Number::format($total_ordem, locale: 'pt_BR') }}</td>
                         @if($resultado_of=false) <td class="alert alert-success" role="alert">A ordem foi cumprida na sua totalidade.</td>
                            @elseif($resultado_of>0)<td class="alert alert-warning" role="alert">A ordem não foi cumprida.</td>
                            @elseif($resultado_of<0)<td class="alert alert-danger" role="alert">Foi recebido mais doque deveria.</td>
                        @endif                      
                           
                     
                    </tr>
                @endif
            </tbody>
            @endif
        </table>


        <div class="d-flex">
            {!! $ordem->links() !!}

        </div>
        <div class="d-flex">

            {!! $ordem->count() !!}
        </div>


    </div>

    <script>
        $(".select2").select2({
            placeholder: 'Selecione',
            allowClear: true,
            tokenSeparators: [',', ' '],
            closeOnSelect: false,

        });
    </script>


    <script>
        const addSelectAll = matches => {
            if (matches.length > 0) {
                // Insert a special "Select all matches" item at the start of the 
                // list of matched items.
                return [{
                        id: 'selectAll',
                        text: 'Selecionar todo o processo',
                        matchIds: matches.map(match => match.id)
                    },
                    ...matches
                ];
            }
        };

        const handleSelection = event => {
            if (event.params.data.id === 'selectAll') {
                $('.select4').val(event.params.data.matchIds);
                $('.select4').trigger('change');
            };
        };

        $('.select4').select2({

            multiple: true,
            sorter: addSelectAll,
            placeholder: 'Selecione',
            allowClear: true,
            tokenSeparators: [',', ' '],
            closeOnSelect: false,

        });
        $('.select4').on('select2:select', handleSelection);
    </script>
<script>
$(document).ready(function () {
    $("#btnExport").click(function (e) {
         e.preventDefault();
         var table_div = document.getElementById('divTabela');   
         // esse "\ufeff" é importante para manter os acentos         
         var blobData = new Blob(['\ufeff'+table_div.outerHTML], { type: 'application/vnd.ms-excel' });
         var url = window.URL.createObjectURL(blobData);
         var a = document.createElement('a');
         a.href = url;
         a.download = 'Meu arquivo Excel'
               a.click();
           });
       });
    </script>

@endsection

