@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Processos Cadastradas</h1>
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

    <div class="d-flex align-itens-center justify-content-between">
         <h1 class="mb-0">  Processos Cadastrados</h1>
         <a href="{{route('processo.create')}}" class="btn btn-primary">Adicionar Processos</a>
   </div>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
     {{Session::get('success')}}
    </div>
 @endif
    <table class="table hover">
        <thead class="table-primary">
            <tr>
                 <th>#</th>  
                    <th>Processo</th>        
                                                         
                    <th>Valor total</th>  
                    <th>Ação</th>                     
          
          </tr>
    </thead>

    <tbody>
        @if($Processo->count()>0)
        @foreach ( $Processo as $rs )
        <tr>
                    <td class = "align-middle">{{$loop->iteration}}</td>
                    <td class = "align-middle">{{$rs->numero}}</td>
                    <td class = "align-middle">{{$rs->valor}}</td>
                    

                    <td class = "align-middle">
                     <div class="btn-group" role="group" aria-label="Basic example">
                     <a href="{{route('processo.show', $rs->id) }}" type="button" class="btn btn-secondary">Detalhes</a>
                   
                     <a href="{{route('processo.edit', $rs->id) }}" type="button" class="btn btn-warning">Editar</a>
                     <form action="{{route('processo.destroy',$rs->id) }}" method="POST">
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
            <td>Não existe  Processos cadastrados</td>
        </tr>
        @endif 
    </tbody>
    </table>
    <div class="d-flex">
        {!! $Processo->links() !!}
    </div>        

</div>



@endsection

