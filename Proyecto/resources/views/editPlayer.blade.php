@extends('layouts.master')
@section('content')
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Editar Jugador</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="namePlayer" class="fuenteBlanca">Nombre del Jugador:</label>
                <input type="text" class="form-control" maxlength="40" name="namePlayerEdit" id="namePlayer" value="{{$jugadorAEditar->name}}" placeholder="Escriba el nombre del Jugador" required>
            </div>
            <div class="form-group">
                <label for="lastnamePlayer" class="fuenteBlanca">Apellido del Jugador:</label>
                <input type="text" class="form-control" name="lastnamePlayerEdit" id="lastnamePlayer" value="{{$jugadorAEditar->last_name}}" placeholder="Escriba el apellido del Jugador" maxlength="40" required>
            </div>
            <div class="form-group">
                <label for="valuePlayer" class="fuenteBlanca">Valor de Mercado:</label>
                <input type="number" class="form-control" name="valuePlayerEdit" id="valuePlayer" value="{{$jugadorAEditar->value}}" placeholder="Inserte valor del Jugador" min="1" max="1000000000" required>
            </div>
            <div class="form-group">
                <label for="positionPlayer" class="fuenteBlanca">Posición del Jugador:</label>
                <select class="form-control" id="positionPlayer" name="positionPlayerEdit" value="{{$jugadorAEditar->position}}" required>
                    @if($jugadorAEditar->position == "Delantero")
                        <option selected="selected">Delantero</option>
                    @else
                        <option>Delantero</option>
                    @endif
                    @if($jugadorAEditar->position == "Centrocampista")
                        <option selected="selected">Centrocampista</option>
                    @else
                        <option>Centrocampista</option>
                    @endif
                    @if($jugadorAEditar->position == "Defensa")
                        <option selected="selected">Defensa</option>
                    @else
                        <option>Defensa</option>
                    @endif
                    @if($jugadorAEditar->position == "Portero")
                        <option selected="selected">Portero</option>
                    @else
                        <option>Portero</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="teamPlayer" class="fuenteBlanca">Equipo del Jugador:</label>
                <select class="form-control" id="teamPlayer" name="teamPlayerEdit" required>
                    @foreach($teams as $team)
                        @if($jugadorAEditar->id_team == $team->id)
                            <option value="{{$team->id}}" selected="selected">{{$team->name}}</option>
                        @else
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="fuenteBlanca">Seleccione la imagen del Jugador:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
    </div>
@endsection
