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
        <form class="form-inline">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Material</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Buscar</div>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Material" value="{{$nome}}">
                <select name="vencimento" id="vencimento" class="form-control" value="{{$vencimento}}">
                    <option value="" disabled selected>Selecione um ano</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                   
                </select>           
                 <input type="text" class="form-control" id="local" name="local" placeholder="Reta,Patrimônio" value="{{$local}}">
                                                                               
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
                 
                
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Vencimento</th>  
                    <th class="text-left">Local de armazenamento</th>
                    <th class="text-left">Quantidade</th>                    
                    <th class="text-center">Foto</th>
                    
                    <th class="text-center">Ação</th>
                

                </tr>
            </thead>

            <tbody>
                @if ($produto->count() > 0)
                    @foreach ($produto as $rs)
                        <tr>
                        
                            <td class = "align-middle">{{ $rs->nome }}</td>
                            <td class = "align-middle">{{ date('d/m/Y', strtotime($rs->vencimento))}}</td>
                            <td class = "align-middle">{{ $rs->local }}</td> 
                            <td class = "align-middle">{{ $rs->quant_total }}</td>                           
                            <td class = "align-middle"><img src="{{ asset($rs->foto) }}" style="width: 70px; height: 70px;" alt="img"/></td>

                            <td class = "align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('produto.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('produto.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>
                                        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#mediumModal-{{$rs->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        @include('produto.MediumModal')
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Não existem Materiais cadastrados</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $produto->links() !!}
        </div>

    </div>



@endsection
