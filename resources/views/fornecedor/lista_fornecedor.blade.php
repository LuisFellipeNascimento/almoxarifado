@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Fornecedores</h1>
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

    <div class="float-right">
        <a href="{{ route('fornecedor.create') }}" class="btn btn-success">Adicionar Fornecedores</a>            
    </div>
    <form class="form-inline">
        <label class="sr-only" for="inlineFormInputGroupUsername2">Nome do fornecedor</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Buscar</div>
            </div>
            <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" placeholder="Nome fantasia" value="{{$nome_fantasia}}">
            <input type="text" class="form-control" id="valor" name="razao_social" placeholder="Razão Social" value="{{$razao_social}}">
                                                                          
        </div>
        
        <div>
        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Procurar</button>
        <a href="{{ route('lista-fornecedor') }}" class="btn btn-warning mb-2">Limpar</a>
        </div>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
     {{Session::get('success')}}
    </div>
 @endif
    <table class="table hover">
        <thead class="table-primary">
            <tr>
                 <th>#</th>  
                    <th>Nome Fantasia</th>        
                    <th>Razão Social</th>
                    <th>Nome do representante</th>
                    <th> Inscricão Estadual</th>
                    <th> Telefone de Contato</th>                    
                    <th>Ação</th>                      
          
          </tr>
    </thead>

    <tbody>
        @if($Fornecedores->count()>0)
        @foreach ( $Fornecedores as $rs )
        <tr>
                    <td class = "align-middle">{{$loop->iteration}}</td>
                    <td class = "align-middle">{{$rs->nome_fantasia}}</td>
                    <td class = "align-middle">{{$rs->razao_social}}</td>
                    <td class = "align-middle">{{$rs->nome_representante}}</td>
                    <td class = "align-middle">{{$rs->inscricao_estadual}}</td>
                    <td class = "align-middle"> {{$rs->telefone}}</td>
                    

                    <td class = "align-middle">
                     <div class="btn-group" role="group" aria-label="Basic example">
                     <a href="{{route('fornecedor.show', $rs->id) }}" type="button" class="btn btn-secondary">Detalhes</a>
                   
                     <a href="{{route('fornecedor.edit', $rs->id) }}" type="button" class="btn btn-warning">Editar</a>
                     <form action="{{route('fornecedor.destroy',$rs->id) }}" method="POST">
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
            <td colspan="9" style="text-align: center">Não existem fornecedores cadastrados.</td>
        </tr>
        @endif 
    </tbody>
    </table>
    <div class="d-flex">
        {!! $Fornecedores->links() !!}
    </div>        

</div>



@endsection

