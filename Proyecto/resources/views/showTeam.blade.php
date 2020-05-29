@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/styles.css')}}">
    <div class="container text-center justify-content-center" style="background-image: url({{asset($team->wallpaper)}}) !important;
    background-repeat: no-repeat;background-size: 100% 100%;">
        <div class="col-md-12 mt-5 mb-5">
            <div class="row prueba2">
                <div class="col-md-9 mt-5 mb-5 cajaJugadores">
                   <div class="row prueba2">
                       @foreach($jugadores as $jugador)
                       <div class="col-md-12 col-lg-6 alturaPerson">
                           <div class="row">
                                   <div class="col-md-1 colorHueco2 heightMinimoColumnasJugadoresShowTeam"></div>
                                   <div class="col-md-3 colorHueco3 heightMinimoColumnasJugadoresShowTeam">
                                       <img  class="img-fluid margenesJugador2" style="height: 80px !important;" src="{{asset($jugador->player_image)}}" alt="Card image cap">
                                   </div>
                                   <div class="col-md-4 colorHueco3 heightMinimoColumnasJugadoresShowTeam">
                                       <h6 class="fuenteBlanca mt-4" >Posición: {{$jugador->position}}</h6>
                                       <h6 class="fuenteOscura mt-4" >{{$jugador->name}} {{$jugador->last_name}}</h6>
                                       <p class="fuenteBlanca mt-4" >Valor de mercado: <span class="fuenteOscura">{{$jugador->value}}€</span></p>
                                   </div>
                                   <div class="col-md-3 colorHueco3 heightMinimoColumnasJugadoresShowTeam">
                                       <img class="img-fluid margenesEquipo2" style="height: 80px !important;" src="{{asset($jugador->image)}}" alt="Card image cap">
                                   </div>
                                   <div class="col-md-1 colorHueco2 heightMinimoColumnasJugadoresShowTeam"></div>
                           </div>
                           <div class="row mt-2">
                               <div class="col-md-12">
                                   @if(Auth::check())
                                       @if(Auth()->user()->role!="Estándar")
                                           <a class="btn btn-success" style="color:white" href="{{url('/editarJugadores/'.$jugador->id)}}" >Editar</a>
                                           <a class="btn btn-danger" href="{{url("/jugadoresEliminar/".$jugador->id)}}" >Eliminar</a>
                                       @endif
                                   @else
                                       <a class="btn btn-success disabled" style="color:white" href="{{url('/editarJugadores/'.$jugador->id)}}">Editar</a>
                                       <a class="btn btn-danger disabled" href="{{url("/jugadoresEliminar/".$jugador->id)}}">Eliminar</a>
                                   @endif
                               </div>
                           </div>
                       </div>
                       @endforeach
                   </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card">
                        <img class="card-img-top mt-3" src="{{asset($team->image)  }}" style="margin-left: 35%;margin-right: 35%;width: 30%" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $team->name }}</b></h5>
                            <p class="card-text text-left textAreaInfoClub"><i>{{$team->review}}</i></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Fundación: {{$team->fundation}}</li>
                            <li class="list-group-item">Estadio: {{$team->stadium}}</li>
                            <li class="list-group-item">Entrenador: {{$team->coach}}</li>
                            @if($team->nationality=="España")
                                <li class="list-group-item">Nacionalidad: <img style="width: 20%" src="{{asset('images/paises/spain.png')}}"></li>
                            @endif
                            @if($team->nationality=="Francia")
                                <li class="list-group-item">Nacionalidad: <img style="width: 20%" src="{{asset('images/paises/francia.png')}}"></li>
                            @endif
                            @if($team->nationality=="Reino Unido")
                                <li class="list-group-item">Nacionalidad: <img style="width: 20%" src="{{asset('images/paises/uk.png')}}"></li>
                            @endif
                            @if($team->nationality=="Alemania")
                                <li class="list-group-item">Nacionalidad: <img style="width: 20%" src="{{asset('images/paises/alemania.png')}}"></li>
                            @endif
                            @if($team->nationality=="Italia")
                                <li class="list-group-item">Nacionalidad: <img style="width: 20%" src="{{asset('images/paises/italia.png')}}"></li>
                            @endif

                        </ul>
                        <div class="card-body">
                            <a target="_blank" href="{{$team->web}}" class="card-link">Web Oficial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection