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

    <div class="d-flex align-itens-center justify-content-between">
    
         <form method ="GET" action="{{route('ordem.index')}}">
            @csrf
    
            <div class="col-12 col-md-15">
            
        <div class="input-group">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> Procurar</button> 

                </div>                                           
        
                <div class="form-group col-md-5">
                    <select name="id_processo"  id="select" class="form-control">      
                        
                        <option value=""  >Selecione um processo.</option>
                        @foreach ( $Processos as $process )
                        <option value="{{$process->id}}" {{$process->id == $id_processo ? 'selected' : ''}} >{{$process->numero}}</option>
                        
                        @endforeach
                    
                       
                    </select>
                </div> 
</form> 
<div class="form-group col-md-5"><a href="{{route('ordem.create')}}" class="btn btn-primary">Adicionar Ordem</a></div>
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
                    <th>Fornecedor</th>
                    <th>Ordem</th>
                    <th>Empenho</th>   
                    <th>Item</th>
                    <th> Valor Total</th>                                      
                    <th>Ação</th>                      
          
          </tr>
    </thead>

    <tbody>
        @if($ordem->count()>0)
        @foreach ( $ordem as $rs )
        <tr>
                    <td class = "align-middle">{{$loop->iteration}}</td>
                    <td class = "align-middle">{{$rs->Processo->numero}}</td>
                    <td class = "align-middle">{{$rs->Fornecedores->nome_fantasia}}</td>
                    <td class = "align-middle">{{$rs->numero_ordem}}</td>
                    <td class = "align-middle">{{$rs->empenho}}</td>                    
                    <td class = "align-middle">{{$rs->item}}</td>
                    <td class = "align-middle"> {{$rs->valor_total}}</td>
                    

                    <td class = "align-middle">
                     <div class="btn-group" role="group" aria-label="Basic example">
                     <a href="{{route('ordem.show', $rs->id) }}" type="button" class="btn btn-secondary">Detalhes</a>
                   
                     <a href="{{route('ordem.edit', $rs->id) }}" type="button" class="btn btn-warning">Editar</a>
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
            <td>Não existe ordens cadastradas nesse processo.</td>
        </tr>
        @endif 
       
        <tr>
            <thead class="table-primary">
                <tr>
                     <th colspan="8">Valor total das ordens do processo  </th>
                     
                                             
            
              </tr>
          </thead>

          <tbody>
                    <td>
                    {{$total_produtos}}
                   </td>
              
                </tr>
         </tbody>

         <thead class="table-primary">
                    <tr>
                        <th >Saldo livre processo  </th>
                        
                                                
                
                </tr>
        </thead>
          <tbody>
           
                <td >{{$resultado}}  </td>   
          
      
        </tr>
 </tbody>
      
    </tbody>
    </table>
    <div class="d-flex">
        {!! $ordem->links() !!}
    </div>  
    
    
  
</div>





@endsection

