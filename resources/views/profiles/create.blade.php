@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Perfil</h1>
        <hr />
        <p>Cadastrar Perfil</p>
        
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
        
        <form method="post" action="{{ route('perfil_salvar') }}">
            {{csrf_field()}}

            <div class="row">

                <div class="col-xl-6 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Informe aqui o nome do Perfil"/>
                    </div>                
                </div>
                
                <div class="col-xl-6 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="description">Descrição:</label>
                        <input type="text" class="form-control" id="name" name="description" value="{{old('description')}}" placeholder="Informe aqui a descrição do Perfil"/>
                    </div>                
                </div>                             
            </div>
            
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="{{url('/perfis')}}" class="btn btn-default">Voltar</a>
        </form>
    </div>                
</div>
<!-- GET IT-->
@endsection
