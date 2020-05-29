@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="col-md-12 justify-content-center text-center" >
        <h1 class="fuenteTitulo mt-3 backGroundCabeceras">Clubes</h1>
        <div class="container">
            <div class="col-md-12 mt-1 mb-5">
                <div class="row prueba mb-5">
                    @foreach($teams as $team)
                        <div class="col-md-3 mt-5">
                                <a href="{{ url('infoClub/'.$team->id) }}">
                                    <img alt="teamImage" class="img-fluid" style="max-height:80px !Important" src="{{$team->image}}"></a>
                            <h6 class="fuenteBlanca">{{$team->name}}</h6>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    @if(Auth::check())
                                        @if(Auth()->user()->role=="Estándar")
                                            <a class="btn btn-success disabled" style="color:white" href="{{url("/editClub/".$team->id)}}" >Editar</a>
                                            <a class="btn btn-danger disabled" href="{{url("/clubes/".$team->id)}}" >Eliminar</a>

                                        @else
                                            @if($team->name=="Real Madrid C.F" || $team->name=="F.C Barcelona")
                                                <a class="btn btn-success" style="color:white" href="{{url("/editClub/".$team->id)}}">Editar</a>
                                                <a class="btn btn-danger disabled" href="{{url("/clubes/".$team->id)}}" >Eliminar</a>
                                            @else
                                                <a class="btn btn-success" style="color:white" href="{{url("/editClub/".$team->id)}}">Editar</a>
                                                <a class="btn btn-danger" href="{{url("/clubes/".$team->id)}}">Eliminar</a>
                                            @endif

                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection