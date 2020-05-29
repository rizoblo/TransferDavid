@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Editar Partido</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="localTeamEditMatch" class="fuenteBlanca">Equipo Local:</label>
                <select class="form-control disabled" id="localTeamEditMatch" name="localTeamEditMatch" value="{{old('localTeamEditMatch')}}" disabled>
                    @foreach($clubes as $club)
                        @if($club->id == $partidoAEditar->id_team_local)
                            <option value="{{$club->id}}" selected="selected">{{$club->name}}</option>
                            <input type="hidden" name="guardarLocalTeamEditMatch" value="{{$club->id}}">
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="visitorTeamEditMatch" class="fuenteBlanca">Equipo Visitante:</label>
                <select class="form-control" id="visitorTeamEditMatch" name="visitorTeamEditMatch" value="{{old('visitorTeamEditMatch')}}" disabled>
                    @foreach($clubes as $club)
                        @if($club->id == $partidoAEditar->id_team_visitor)
                            <option value="{{$club->id}}" selected="selected">{{$club->name}}</option>
                            <input type="hidden" name="guardarVisitorTeamEditMatch" value="{{$club->id}}">
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="scoreLocalEditMatch" class="fuenteBlanca">Marcador del local:</label>
                <input type="number" class="form-control" name="scoreLocalEditMatch" id="scoreLocalEditMatch" value="{{$partidoAEditar->score_local}}" min="0" required>
            </div>
            <div class="form-group">
                <label for="scoreVisitorEditMatch" class="fuenteBlanca">Marcador del visitante:</label>
                <input type="number" class="form-control" name="scoreVisitorEditMatch" id="scoreVisitorEditMatch" value="{{$partidoAEditar->score_visitor}}" min="0" required>
            </div>
            <input type="hidden" value="{{$partidoAEditar->id}}" name="guardarIdEditMatch">
            <button class="btn btn-success" type="submit" name="guardarEditMatch">Guardar</button>
        </form>
        <br>
        <a href="{{url('/deleteMatch/'.$partidoAEditar->id)}}"><button class="btn btn-danger" name="eliminarEditMatch">Eliminar</button></a>
        <br>
    </div>
    @endsection