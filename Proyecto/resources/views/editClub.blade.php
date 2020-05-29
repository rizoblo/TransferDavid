@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/styles.css')}}">
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Editar Equipo</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if($club->name!="Real Madrid C.F" && $club->name!="F.C Barcelona")
                <div class="form-group">
                    <label for="name" class="fuenteBlanca">Nombre del Equipo:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$club->name}}" placeholder="Escriba el nombre del Equipo" maxlength="50" required>
                </div>
            @endif

            <div class="form-group">
                <label for="fundation" class="fuenteBlanca">Año de fundación del Equipo:</label>
                <input type="number" class="form-control" name="fundation" id="fundation" value="{{$club->fundation}}" min="1850" max="2020" placeholder="Escriba el año de fundación del Equipo" required>
            </div>
            <div class="form-group">
                <label for="stadium" class="fuenteBlanca">Nombre del Estadio:</label>
                <input type="text" class="form-control" name="stadium" id="stadium" value="{{$club->stadium}}" placeholder="Escriba el nombre del Estadio" maxlength="50" required>
            </div>
            <div class="form-group">
                <label for="coach" class="fuenteBlanca">Nombre del Entrenador:</label>
                <input type="text" class="form-control" name="coach" id="coach" value="{{$club->coach}}" maxlength="50" placeholder="Escriba el Entrenador" required>
            </div>
            <div class="form-group">
                <label for="nationality" class="fuenteBlanca">Nacionalidad del Equipo:</label>
                <select class="form-control" id="nationality" name="nationality" value="{{$club->nationality}}" required>
                    @if($club->nationality=="España")
                        <option selected="selected">España</option>
                        <option>Francia</option>
                        <option>Reino Unido</option>
                        <option>Alemania</option>
                        <option>Italia</option>
                    @endif
                    @if($club->nationality=="Francia")
                        <option>España</option>
                        <option selected="selected">Francia</option>
                        <option>Reino Unido</option>
                        <option>Alemania</option>
                        <option>Italia</option>
                    @endif
                    @if($club->nationality=="Reino Unido")
                        <option>España</option>
                        <option>Francia</option>
                        <option selected="selected">Reino Unido</option>
                        <option>Alemania</option>
                        <option>Italia</option>
                    @endif
                    @if($club->nationality=="Alemania")
                        <option>España</option>
                        <option>Francia</option>
                        <option>Reino Unido</option>
                        <option selected="selected">Alemania</option>
                        <option>Italia</option>
                    @endif
                    @if($club->nationality=="Italia")
                        <option>España</option>
                        <option>Francia</option>
                        <option>Reino Unido</option>
                        <option>Alemania</option>
                        <option selected="selected">Italia</option>
                    @endif

                </select>
            </div>
            <div class="form-group">
                <label for="review" class="fuenteBlanca">Breve reseña del Equipo:</label>
                <textarea class="form-control" name="review" value="{{old('review')}}" id="review" rows="6" placeholder="Escriba su reseña" maxlength="2400" required>{{$club->review}}</textarea>
            </div>
            <div class="form-group">
                <label for="web" class="fuenteBlanca">Web del Equipo:</label>
                <input type="text" class="form-control" name="web" id="web" value="{{$club->web}}" placeholder="Escriba la web del Equipo" maxlength="120" required>
            </div>
            <div class="form-group">
                <label for="image" class="fuenteBlanca">Seleccione el Escudo:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="wallpaper" class="fuenteBlanca">Seleccione el Fondo:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="wallpaper" name="wallpaper" accept="image/*">
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
    </div>
    @endsection