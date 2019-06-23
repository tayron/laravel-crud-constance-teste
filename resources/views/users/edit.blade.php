@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Usuário</h1>
        <hr />
        <p>Editar Usuário</p>
        <div class="alert alert-warning">
            A foto do usuário deve ser no formato png, jpg ou jpeg e deve possuir o tamanho 250x250 pixels            
        </div>
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
        <form method="POST" action="{{ route('usuario_atualizar') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$user->id}}" />
            <input type="hidden" name="name_photo_old" value="{{$user->photo}}" />            

            <div class="row">
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">
                        <img src="{{url("storage/upload/img/users/{$user->photo}")}}" alt="{{$user->name}}" class="img" />
                    </div>                    
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="profile_id">Perfil:</label>
                        <select id="profile_id" name="profile_id" class="form-control">
                            <option value="">Selecione</option>  
                            @foreach($listProfiles as $profile)
                            @if($profile->id == old('profile_id'))
                            <option selected value="{{$profile->id}}">{{$profile->name}}</option>  
                            @elseif($profile->id == $user->profile_id)
                            <option selected value="{{$profile->id}}">{{$profile->name}}</option>  
                            @else
                            <option value="{{$profile->id}}">{{$profile->name}}</option>  
                            @endif
                            @endforeach
                        </select>
                    </div>                    
                </div>        
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="name">Nome do Usuário:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Informe aqui o nome do usuário"/>
                    </div>                    
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="usuario@dominio.com.br"/>
                    </div>                    
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="birthdate">Data de aniversário:</label>
                        <input type="text" class="form-control" id="birthdate" name="birthdate" value="{{(new \DateTime($user->birthdate))->format('d/m/Y')}}" placeholder="dd/mm/YYYY"/>
                    </div>                     
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="occupation">Cargo:</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="{{$user->occupation}}" placeholder="Informe aqui a profissão do usuário"/>
                    </div>                    
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="salary">Salário:</label>
                        <input type="text" class="form-control" id="salary" name="salary" value="{{number_format($user->salary, 2, ',', '.')}}" placeholder="0.000,00"/>
                    </div>                    
                </div>
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="phone">Telefone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="(31) 1234-4567"/>
                    </div>                      
                </div>     
                
                <div class="col-xl-4 col-md-6 com-sm-12">
                    <div class="form-group">    
                        <label for="photo">Foto do usuário:</label>
                        <input type="file"id="photo" name="photo" class="form-control" style="padding: 0" />                        
                    </div>                    
                </div>                
            </div>

            <button type="submit" class="btn btn-success">Alterar</button>
            <a href="{{url('/usuarios')}}" class="btn btn-default">Voltar</a>
        </form>
    </div>                
</div>
<!-- GET IT-->
@endsection
