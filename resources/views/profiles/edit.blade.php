@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Perfil</h1>
        <hr />
        <p>Editar Perfil</p>

        @include('elements.message_success_error')

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        
        <br />
        
        <form method="POST" action="{{ route('perfil_atualizar') }}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$profile->id}}" />            

            <div class="row">
                
                <div class="col-xl-6 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$profile->name}}" placeholder="Informe aqui o nome do Perfil"/>
                    </div>                    
                </div>
                
                <div class="col-xl-6 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="description">Descrição:</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{$profile->description}}" placeholder="Informe aqui a descrição do Perfil"/>
                    </div>                    
                </div>                              
            </div>

            <button type="submit" class="btn btn-success">Alterar</button>
            <a href="{{url('/perfis')}}" class="btn btn-default">Voltar</a>
        </form>
    </div>                
</div>
<!-- GET IT-->
@endsection
