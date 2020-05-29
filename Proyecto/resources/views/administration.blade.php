@extends('layouts.master')
@section('content')
<div class="container justify-content-center text-center">
    <h2 class="titulo fuenteTitulo  mt-5">Tu rol: {{ Auth()->user()->role }}</h2>
    <div class="col-lg-12 margenCajaAdministration">
        <div class="row">
            <div class="col-lg-3">
                <ul class="acorh">
                    <li><a href="#">EQUIPOS</a>
                        <ul>
                            <li><a href="{{url('/clubes')}}">Ver equipos</a></li>
                            <li><a href="{{url('/addTeam')}}">Añadir equipos</a></li>
                        </ul>
                    </li>
                    <li><a href="#">JUGADOR</a>
                        <ul>
                            <li><a href="{{url('/jugadores')}}">Ver jugadores</a></li>
                            <li><a href="{{url('/addPlayer')}}">Añadir jugadores</a></li>
                        </ul>
                    </li>
                    <li><a href="#">NOTICIAS</a>
                        <ul>
                            <li><a href="{{url('/')}}">Ver noticias</a></li>
                            <li><a href="{{url('/addNotice')}}">Añadir noticias</a></li>
                        </ul>
                    </li>
                    <li><a href="#">PARTIDOS</a>
                        <ul>
                            <li><a href="{{url('/matches')}}">Ver partidos</a></li>
                            @if(Auth()->user()->role=="Creador")
                                <li><a href="" style="background-color: red !important;">Añadir partido</a></li>
                            @else
                                <li><a href="{{url('/addMatch/false')}}">Añadir partido</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="col-lg-12 table-responsive" style="margin-top: 2%;margin-bottom: 10%">
                    <table class="table table-bordered fuenteBlanca">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Equipo Favorito</th>
                                <th scope="col">Rol</th>
                                <th scope="col" colspan="2">Acciones</th>
                            </tr>
                            </thead>
                        @foreach($arrayUsers as $user)
                            <tbody>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @foreach($teams as $team)
                                @if($team->id == $user->fav_team)
                                    <td>{{ $team->name }}</td>
                                @endif
                            @endforeach
                            <td>{{ $user->role }}</td>
                            <td>
                                @if(Auth()->user()->role=="Creador")
                                    <a href="{{url('/editUser/'.$user->id.'/admin')}}" class="btn btn-warning disabled" disabled>Editar</a>
                                @else
                                    <a href="{{url('/editUser/'.$user->id.'/admin')}}" class="btn btn-warning">Editar</a>
                                @endif

                            </td>
                            <td>
                                @if(Auth()->user()->role=="Creador")
                                <a href="{{url('/deleteUser/'.$user->id.'/admin')}}" class="btn btn-danger disabled" disabled>Eliminar</a>
                                @else
                                    <a href="{{url('/deleteUser/'.$user->id.'/admin')}}" class="btn btn-danger">Eliminar</a>
                                @endif
                            </td>
                            </tbody>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

</div>
@endsection
