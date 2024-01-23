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
    <form  action="{{route('processo.store')}}" method="POST">
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
        @if(Session::has('success'))
           <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
           </div>
        @endif            
         
        <label class="control-label mb-1" >Número do processo</label>
        <input type="text" class= "form-control"  name="numero" id="numero" placeholder="Número do processo" >
        
        <label class="control-label mb-1">Descricão</label>
        <input type="text" class= "form-control"  name="descricao" id="descricao" placeholder="Diga o objetivo do material a ser adquirido" >         
        
        <label class="control-label mb-1">Valor total</label>
        <input type="text"   class="form-control" name="valor" id="valor">

/>
 <br>
 
        <button type="submit">Cadastrar</button>

  
 

    </form>

</div>



@endsection

