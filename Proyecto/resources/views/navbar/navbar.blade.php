<nav class="navbar navbar-expand-lg navbar-dark bg-info" style="font-family: 'Franklin Gothic Medium';font-size: 20px">
    <a class="navbar-brand" href="{{url("/")}}">TRANSFERDAVID</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link espaciado1 colorNavLink"  href="{{url("/jugadores")}}">JUGADORES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link espaciado1 colorNavLink"  href="{{url("/clubes")}}">CLUBES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link espaciado1 colorNavLink"  href="{{url("/matches")}}">PARTIDOS</a>
            </li>
            <li class="nav-item dropdown " style="min-width: 6rem !important;">
                <a class="nav-link dropdown-toggle espaciado1 espaciado3 colorNavLink" id="estilosMenuPerfil" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LIGAS</a>
                <div class="dropdown-menu" style="width:100px !important;background-color: #343a40" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item espaciado2 colorNavLink" style="background-color: #343a40;color:white;" href="{{url("/league/1")}}">Liga Santander</a>
                    <!--<div class="dropdown-divider"></div>-->
                    <!--<a class="dropdown-item espaciado2 colorNavLink" style="background-color: #343a40;color:white;" href="{{url("/league/3")}}">Premier League</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item espaciado2 colorNavLink" style="background-color: #343a40;color:white;" href="{{url("/league/4")}}">Serie A</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item espaciado2 colorNavLink" style="background-color: #343a40;color:white;" href="{{url("/league/5")}}">Bundesliga</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item espaciado2 colorNavLink" style="background-color: #343a40;color:white;" href="{{url("/league/6")}}">Ligue 1</a>-->
                </div>
            </li>

            @if(Auth::check() && Auth()->user()->role != "Estándar")
                <!--<li class="nav-item">
                    <a class="nav-link"  href="{{url("/adminUsers")}}">Administrar Usuarios</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link espaciado1 colorNavLink"  href="{{url("/administration")}}">Administrar</a>
                </li>

            @endif

        </ul>
        <!--GESTION BOTON INICIO DE SESION-->
        @if(Auth::check())
            <li class="nav-item dropdown estiloNombreUsu">
                <a class="nav-link dropdown-toggle tamanioMovil1" style="border:1px solid white;border-radius: 15%;" href="#" id="menuPerfil" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth()->user()->name}}
                </a>
                <div class="dropdown-menu mt-2" style="background-color: #17a2b8" aria-labelledby="navbarDropdown">
                    <form action="{{url('/editUser/'.Auth()->user()->id.'/noAdmin')}}" class="form-inline justify-content-center" method="POST">
                        @method('GET')
                        {{ csrf_field() }}
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Editar Perfil</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <form action="{{url('logout')}}" class="form-inline justify-content-center" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-light " type="submit">Cerrar Sesión</button>
                    </form>
                </div>
            </li>

        @else
            <form action="{{url('login')}}" class="form-inline my-2 my-lg-0" method="POST">
                {{ csrf_field() }}
                @method('GET')
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Iniciar Sesión</button>
            </form>
        @endif
    </div>
</nav>