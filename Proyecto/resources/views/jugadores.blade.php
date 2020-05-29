@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="col-md-12 justify-content-center text-center">
        <h1 class="fuenteTitulo mt-3 mb-5 backGroundCabeceras">Jugadores</h1>
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <form action="" method="POST" class="estilosFormFiltrarJugador mt-2 pl-5 pr-5 text-left" style="">
                                        @csrf
                                        <label for="busquedaJugador" class="fuenteBlanca">Busque su jugador</label>
                                        <input type="text" class="form-control inpJug bg-info" placeholder="Busque su jugador" name="nameFindPlayer">
                                        <label for="selectEquipo" class="fuenteBlanca mt-2">Seleccione Equipo</label>
                                        <select class="form-control text-white bg-info" id="selectEquipo" name="teamFindPlayer">
                                            @foreach($teams as $team)
                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                            @endforeach
                                                <option selected="selected">Todos</option>
                                        </select>
                                        <label for="selectPosicion" class="fuenteBlanca mt-2">Seleccione Posición</label>
                                        <select class="form-control text-white bg-info" id="positionFindPlayer" name="positionFindPlayer">
                                            <option>Delantero</option>
                                            <option>Centrocampista</option>
                                            <option>Defensa</option>
                                            <option>Portero</option>
                                            <option selected="selected">Todas</option>
                                        </select>
                                        <input type="submit" class="btn btn-light mt-2" value="Buscar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                    <div class="row">
                        @foreach($jugadores as $jugador)
                        <div class="col-lg-6 col-md-12 mt-1" style="padding-right: 0px !important;padding-left: 0px !important;)">
                            <div class="row at6">
                                <div class="col-md-4 aT4" style="border: 1px solid black;">
                                    <img alt="playerImage" class="img-fluid margenesJugador at5"  src="{{$jugador->player_image}}" alt="Card image cap">
                                </div>
                                <div class="col-md-4" style="border: 1px solid black;">
                                    <div class="at9">
                                    <p class="fuenteBlanca mt-4 at10"><b>Posición: {{$jugador->position}}</b></p>
                                    <p class="fuenteOscura mt-4 at8"><b>{{$jugador->name}} {{$jugador->last_name}}</b></p>
                                    <p class="fuenteBlanca mt-4 at10">Valor de mercado: <span class="fuenteOscura"><b class="at7">{{$jugador->value}}€</b></span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 " style="border: 1px solid black;">
                                    <img alt="teamImage" class="img-fluid margenesEquipo" style="height: 115px !important;" src="{{$jugador->image}}" alt="Card image cap">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="POST" style="">
                                        @csrf
                                        @method('PUT')
                                        @if(Auth()->check())
                                            @if(Auth()->user()->role!="Estándar")
                                                <a class="btn btn-success mt-2 mb-2" href="{{url('/editarJugadores/'.$jugador->id)}}">Editar</a>
                                                <a class="btn btn-danger mt-2 mb-2" style="color:white" href="{{url("/jugadoresEliminar/".$jugador->id)}}">Eliminar</a>
                                            @endif
                                        @else
                                            <a class="btn btn-success disabled mt-2 mb-2" href="{{url('/editarJugadores/'.$jugador->id)}}">Editar</a>
                                            <a class="btn btn-danger disabled mt-2 mb-2" style="color:white" href="{{url("/jugadoresEliminar/".$jugador->id)}}">Eliminar</a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>
    </div>
@endsection