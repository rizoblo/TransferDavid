@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
        <h1 class="fuenteTitulo text-center mt-5">Todos los Usuarios</h1>
        <div class="col-md-12 text-center">
            <div class="container">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col-md-12 table-responsive" style="margin-top: 5%;margin-bottom: 10%">
                            <table class="table table-bordered fuenteBlanca">
                            @foreach($arrayUsers as $user)

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
                                            <a href="{{url('/editUser/'.$user->id.'/admin')}}" class="btn btn-warning">Editar</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/deleteUser/'.$user->id.'/admin')}}" class="btn btn-danger">Eliminar</a>
                                        </td>
                                    </tbody>

                            @endforeach
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>



@endsection