@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <h1>Perfis de Usuário</h1>
        
        @include('elements.message_success_error')
        
        <a href="{{url('/perfil/novo/')}}" class="btn btn-sm btn-success float-right">Novo perfil</a>
        <br /><br /><br />
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 10%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listProfiles as $profile)
                    <tr>
                        <td>{{$profile->id}}</td>
                        <td>{{$profile->name}}</td>
                        <td>{{$profile->description}}</td>
                        <td class="actions">
                            <div class="btn-group">
                                <a href="{{url('/perfil/editar/' . $profile->id)}}" class="btn btn-info btn-sm" title="Editar">
                                    Editar
                                </a>
                                <form name="post_{{$profile->id}}" style="display:none;" method="post" action="{{url('/perfil/excluir/')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$profile->id}}">
                                </form>
                                
                                <a href="#" class="btn btn-danger btn-sm" title="Excluir" onclick="if (confirm('Tem certeza que deseja excluir o registro # {{$profile->id}}?')) {
                                        document.post_{{$profile->id}}.submit();
                                            }
                                            event.returnValue = false;
                                            return false;">
                                    Apagar
                                </a>
                            </div>                                
                        </td>                                        
                    </tr>
                    @endforeach
                </tbody>
            </table>                    
            {{ $listProfiles->links() }}
        </div>
    </div>
</div>
<!-- GET IT-->
@endsection
