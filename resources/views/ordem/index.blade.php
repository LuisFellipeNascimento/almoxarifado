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
                        <li class="active"><div class="float-right"><a href="{{ route('ordem.create') }}" class="btn btn-success">Adicionar Ordem</a></div></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">      
                

            <form method ="GET"  action="{{ route('ordem.index') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                            <label for="id_processo" class="control-label mb-1">Processo</label>
                            <select name="id_processo" id="select2" class="select2 form-control cc-exp">

                                            <option value="">Processos</option>
                                            @foreach ($Processos as $process)
                                                <option value="{{ $process->id }}"
                                                    {{ $process->id == $id_processo ? 'selected' : '' }}>{{ $process?->numero }}</option>
                                            @endforeach


                                        </select>
                    </div>        
                    <div class="col-md-6 mb-3">
                                       <label  for="id_fornecedor" class="control-label mb-1"> Fornecedor</label>                                      
                                
                                        <select name="id_fornecedor"  id="select3" class="select3 form-control cc-exp">

                                            <option value="">Ver todos os fornecedores envolvidos.</option>
                                            @foreach ( $Fornecedores as $Fornecedor )
                                                <option value="{{ $Fornecedor->id }}"
                                                    {{ $Fornecedor->id == $id_fornecedor ? 'selected' : '' }}>{{ $Fornecedor->nome_fantasia }}</option>
                                            @endforeach
                                    </select>
                                   
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
                            <td class = "align-middle"> {{ Number::format($rs->valor_total,locale: 'pt_BR') }} R$</td>
                            


                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('ordem.show', $rs->id) }}" type="button"
                                        class="btn btn-secondary">Detalhes</a>

                                    <a href="{{ route('ordem.edit', $rs->id) }}" type="button"
                                        class="btn btn-info">Editar</a>


                                             <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#mediumModal-{{$rs->id}}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            @include('ordem.MediumModal')
                              
                                    


                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Não existe ordens cadastradas nesse processo.</td>
                    </tr>
                @endif
                        @if(isset($id_processo) and ($id_fornecedor==false) )
                                @if($resultado==0)
                                <div class="alert alert-success" role="alert">Processo bem aproveitado</div>                   
                                @elseif($resultado>0) 
                                <div class="alert alert-warning" role="alert">Existe {{Number::format($resultado,locale: 'pt_BR')}} R$ de saldo disponíveis a serem pedidos!</div>
                                @elseif($resultado<0) 
                                <div class="alert alert-danger" role="alert">Você pediu {{Number::format($resultado,locale: 'pt_BR')}} R$ a mais que deveria, contate o Departamento de compras!</div>
                        @endif
                
        @endif
                
                @if(isset($id_processo) )
                <tr>
                    <thead class="table-primary">
                        <tr>
                            <th colspan="8">Valor total das ordens do processo desse fornecedor. </th>



                        </tr>
                    </thead>

            <tbody>
                <td>
                    {{ Number::format($total_produtos,locale: 'pt_BR') }} R$
                </td>

                </tr>
            </tbody>

            <thead class="table-primary">
                <tr>
                    <th>Saldo livre processo </th>



                </tr>
            </thead>
            <tbody>
                @if(!isset($id_fornecedor))
                <tr>
                    <td>
                    {{ Number::format( $resultado,locale: 'pt_BR')  }} R$
                    </td>
                </tr>                  
                 @endif
               
                   
                
            </tbody>

            </tbody>
            

           
            @endif
        </table>

        
        <div class="d-flex">
            {!! $ordem->links() !!}
        </div>
        

    </div>

    <script>
        $(".select2").select2({   
                                         
            
        });

    </script>
    <script>
        $(".select3").select2({   
                                         
            
        });      

    </script> 

  

@endsection

