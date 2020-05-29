@extends('layouts.master')
@section('content')
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Añadir Equipo</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="fuenteBlanca">Nombre del Equipo:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" maxlength="50" placeholder="Escriba el nombre del Equipo" required>
            </div>
            <div class="form-group">
                <label for="fundation" class="fuenteBlanca">Año de fundación del Equipo:</label>
                <input type="number" class="form-control" name="fundation" id="fundation" value="{{old('fundation')}}" min="1850" max="2020" placeholder="Escriba el año de fundación del Equipo" required>
            </div>
            <div class="form-group">
                <label for="stadium" class="fuenteBlanca">Nombre del Estadio:</label>
                <input type="text" maxlength="50" class="form-control" name="stadium" id="stadium" value="{{old('stadium')}}" placeholder="Escriba el nombre del Estadio" required>
            </div>
            <div class="form-group">
                <label for="coach" class="fuenteBlanca">Nombre del Entrenador:</label>
                <input type="text" maxlength="50" class="form-control" name="coach" id="coach" value="{{old('coach')}}" placeholder="Escriba el Entrenador" required>
            </div>
            <div class="form-group">
                <label for="nationality" class="fuenteBlanca">Nacionalidad del Equipo:</label>
                <select class="form-control" id="nationality" name="nationality" value="{{old('nationality')}}" required>
                    <option selected="selected">España</option>
                    <option>Francia</option>
                    <option>Reino Unido</option>
                    <option>Alemania</option>
                    <option>Italia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review" class="fuenteBlanca">Breve reseña del Equipo:</label>
                <textarea class="form-control" maxlength="2400" name="review" value="{{old('review')}}" id="review" rows="6" placeholder="Escriba su reseña" required></textarea>
            </div>
            <div class="form-group">
                <label for="web" class="fuenteBlanca">Web del Equipo:</label>
                <input type="text" maxlength="120" class="form-control" name="web" id="web" value="{{old('web')}}" placeholder="Escriba la web del Equipo" required>
            </div>
            <div class="form-group">
                <label for="image" class="fuenteBlanca">Seleccione el Escudo:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="image" name="image" value="{{old('image')}}" required>
            </div>
            <div class="form-group">
                <label for="wallpaper" class="fuenteBlanca">Seleccione el Fondo:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="wallpaper" name="wallpaper" value="{{old('wallpaper')}}" required>
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
    </div>
@endsection
