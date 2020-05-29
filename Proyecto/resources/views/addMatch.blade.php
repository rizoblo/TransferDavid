@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">

    <h1 class="fuenteTitulo text-center mt-5 mb-5" name="bienvenidaAddMatchMadrid">Datos del partido a añadir</h1>

    <div class="container fuenteBlanca w-50">
        <form action="" method="POST" class="formAddMatch">
            @csrf
            <div class="form-group">
                <label for="localTeam" class="fuenteBlanca">Equipo local:</label>
                <select class="form-control" id="localTeam" name="localTeamAddMatch" value="{{old('localTeam')}}">
                    @foreach($equipos as $club)
ç                            <option value="{{$club->id}}">{{$club->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="visitorTeam" class="fuenteBlanca">Equipo visitante:</label>
                <select class="form-control" id="visitorTeam" name="visitorTeamAddMatch" value="{{old('visitorTeam')}}">
                    @foreach($equipos as $club)
                            <option value="{{$club->id}}" >{{$club->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="league" class="fuenteBlanca">Liga:</label>
                <select class="form-control" id="league" name="league" value="{{old('league')}}">
                    @foreach($ligas as $liga)
                        <option value="{{$liga->id}}">{{$liga->name}}</option>
                    @endforeach
                </select>
            </div>

            @if(isset($existenciaPartido))
            
                @if($existenciaPartido=="localExiste")
                    <p style="color:red">*Esa jornada ya existe en esa liga para el equipo local*</p>
                @endif
                @if($existenciaPartido=="visitanteExiste")
                <p style="color:red">*Esa jornada ya existe en esa liga para el equipo visitante*</p>
                @endif
                @if($existenciaPartido=="ambosExisten")
                <p style="color:red">*Esa jornada ya existe para ambos equipos en esa liga*</p>
                @endif
            @endif  
            <div class="form-group">
                <label for="journey" class="fuenteBlanca">Jornada:</label>
                <input type="number" class="form-control" name="journey" value=" {{ old('journey') }} " required min="1" id="journey" >
            </div>

            <div class="form-group">
                <label for="scoreLocal" class="fuenteBlanca">Marcador Local:</label>
                <input type="number" class="form-control" name="scoreLocal" value=" {{ old('scoreLocal') }} " required id="scoreLocal"  min="0">
            </div>
            <div class="form-group">
                <label for="scoreVisitor" class="fuenteBlanca">Marcador Visitante:</label>
                <input type="number" class="form-control" name="scoreVisitor" value=" {{ old('scoreVisitor') }} " required id="scoreVisitor"  min="0" >
            </div>


            <button class="btn btn-success" type="submit" name="guardarPartidoAddMatch">Guardar</button>
        </form>

    </div>
@endsection