@extends('layouts.master')
@section('content')
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Añadir Jugador</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="namePlayer" class="fuenteBlanca">Nombre del Jugador:</label>
                <input type="text" class="form-control" maxlength="40" name="namePlayer" id="namePlayer" value="{{old('namePlayer')}}" placeholder="Escriba el nombre del Jugador" required>
            </div>
            <div class="form-group">
                <label for="lastnamePlayer" class="fuenteBlanca">Apellido del Jugador:</label>
                <input type="text" class="form-control" maxlength="40" name="lastnamePlayer" id="lastnamePlayer" value="{{old('lastnamePlayer')}}" placeholder="Escriba el apellido del Jugador" required>
            </div>
            <div class="form-group">
                <label for="valuePlayer" class="fuenteBlanca">Valor de Mercado:</label>
                <input type="number" class="form-control" min="1" max="1000000000" name="valuePlayer" id="valuePlayer" value="{{old('valuePlayer')}}" placeholder="Inserte valor del Jugador" required>
            </div>
            <div class="form-group">
                <label for="positionPlayer" class="fuenteBlanca">Posición del Jugador:</label>
                <select class="form-control" id="positionPlayer" name="positionPlayer" value="{{old('positionPlayer')}}" required>
                    <option selected="selected">Delantero</option>
                    <option>Centrocampista</option>
                    <option>Defensa</option>
                    <option>Portero</option>
                </select>
            </div>
            <div class="form-group">
                <label for="teamPlayer" class="fuenteBlanca">Equipo del Jugador:</label>
                <select class="form-control" id="teamPlayer" name="teamPlayer" value="{{old('teamPlayer')}}" required>
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="fuenteBlanca">Seleccione la imagen del Jugador:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="image" name="image" value="{{old('image')}}" accept="image/*" required>
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
    </div>
@endsection
