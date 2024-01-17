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
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">      
        <div class="float-right"><a href="{{ route('ordem.create') }}" class="btn btn-success">Adicionar Ordem</a></div>        

            <form method ="GET" class="form-inline" action="{{ route('ordem.index') }}">
                @csrf

                <label class="sr-only" for="inlineFormInputGroupUsername2">Processo</label>
                <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Processo</div>
                        </div>   
                         <div>
                            <select name="id_processo" id="select" class="form-control">

                                <option value="">Ver todas as ordens.</option>
                                @foreach ($Processos as $process)
                                    <option value="{{ $process->id }}"
                                        {{ $process->id == $id_processo ? 'selected' : '' }}>{{ $process->numero }}</option>
                                @endforeach


                            </select>
                          </div> 
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fornecedor</div>
                            </div>   
                          <div> 
                            <select name="id_fornecedor" id="select" class="form-control">

                                <option value="">Ver todas os fornecedores.</option>
                                @foreach ( $Fornecedores as $Fornecedor )
                                    <option value="{{ $Fornecedor->id }}"
                                        {{ $Fornecedor->id == $id_fornecedor ? 'selected' : '' }}>{{ $Fornecedor->nome_fantasia }}</option>
                                @endforeach
                           </select>
                          </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
                <a href="{{ route('ordem.index') }}" class="btn btn-warning mb-2">Limpar</a>
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
                    <th>#</th>
                    <th>Processo</th>
                    <th>Fornecedor</th>
                    <th>Ordem</th>
                    <th>Empenho</th>
                    <th>Item</th>
                    <th> Valor Total</th>
                    <th>Ação</th>

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
                            <td class = "align-middle"> {{ $rs->valor_total }}</td>


                            <td class = "align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('ordem.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('ordem.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                    <form action="{{ route('fornecedor.destroy', $rs->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0" type="submit">Apagar</button>

                                    </form>


                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Não existe ordens cadastradas nesse processo.</td>
                    </tr>
                @endif
                @if(isset($id_processo))
                <tr>
                    <thead class="table-primary">
                        <tr>
                            <th colspan="8">Valor total das ordens do processo desse fornecedor. </th>



                        </tr>
                    </thead>

            <tbody>
                <td>
                    {{ Number::format($total_produtos,locale: 'pt_BR') }}R$
                </td>

                </tr>
            </tbody>

            <thead class="table-primary">
                <tr>
                    <th>Saldo livre processo </th>



                </tr>
            </thead>
            <tbody>
                <tr>  <td>
                    {{ $resultado }}
                </td>
               

                </tr>
            </tbody>

            </tbody>
            @endif
        </table>
        <div class="d-flex">
            {!! $ordem->links() !!}
        </div>
        @if($resultado==0)
        <div class="alert alert-success" role="alert">Processo bem aproveitado</div>                   
        @elseif($resultado>0) 
        <div class="alert alert-warning" role="alert">Existe {{Number::format($resultado,locale: 'pt_BR')}} R$ de saldo disponíveis a serem pedidos!</div>
        @endif
       

    </div>





@endsection
