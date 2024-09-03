@extends('web.home')
@section('content')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Cadastrar unidade</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">unidade</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <form  action="{{route('unidades.store')}}" enctype="multipart/form-data" method="POST">
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
            
            <label class="control-label mb-1" >Nome</label>           
            <textarea  class= "form-control" name="nome" id="nome"  value="{{ old('nome')}}" placeholder="Digite o nome da unidade"  ></textarea>
            
    
     <br>
     
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
    
    
     
    
        </form>
    
    </div>
 

@endsection
