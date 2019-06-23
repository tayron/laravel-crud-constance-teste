<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="{{url('/usuarios')}}">Constance</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/usuarios')}}">Usuário <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/perfis')}}">Perfil de usuário <span class="sr-only">(current)</span></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="https://github.com/tayron/constance-teste" target="__blank" title="Clique aqui para acessar repositório do código fonte deste projeto">Github</a>
      </li>
    </ul>
  </div>
</nav>