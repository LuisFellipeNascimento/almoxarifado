@extends('web.home')
@section('content')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar categoria</h1>
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
    
    <form  action="{{route('categorias.update',$categorias->id)}}" method="POST" id="form-id">
        @csrf
        @method('PUT')
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
        <label class="control-label mb-1" >Nome da categoria</label>
                  
        <textarea  class= "form-control" name="nome_categoria" id="nome_categoria"  placeholder="Digite o nome da categoria"  >{{ $categorias->nome_categoria}}</textarea>
        
 <br>

        <button type="submit" class="btn btn-primary btn-lg btn-block medio">Editar</button>
  </form>

</div>


@endsection