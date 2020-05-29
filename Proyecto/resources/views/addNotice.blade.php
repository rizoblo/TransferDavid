@extends('layouts.master')
@section('content')
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Añadir Noticia</h1>
    <div class="container w-50">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titleNoticeAdd" class="fuenteBlanca">Título de la Noticia:</label>
                <input type="text" class="form-control" name="titleNoticeAdd" id="titleNoticeAdd" maxlength="40" value="{{old('titleNoticeAdd')}}" placeholder="Escriba el título de la Noticia" maxlength="50" required>
            </div>
            <div class="form-group">
                <label for="subtitleNoticeAdd" class="fuenteBlanca">Subtítulo de la Noticia:</label>
                <input type="text" class="form-control" maxlength="120" name="subtitleNoticeAdd" id="subtitleNoticeAdd" value="{{old('subtitleNoticeAdd')}}" placeholder="Escriba el subtítulo de la Noticia" maxlength="60" required>
            </div>
            <div class="form-group">
                <label for="descriptionNoticeAdd" class="fuenteBlanca">Descripción de la Noticia:</label>
                <textarea class="form-control" maxlength="2900" name="descriptionNoticeAdd" value="{{old('descriptionNoticeAdd')}}" id="descriptionNoticeAdd" rows="15" maxlength="2500" placeholder="Escriba el cuerpo de la Noticia" required></textarea>

            </div>
            <div class="form-group">
                <label for="image" class="fuenteBlanca">Seleccione la imagen de la Noticia:</label><br>
                <input type="file" class="fuenteBlanca" class="form-control-file" id="image" name="image" value="{{old('image')}}" accept="image/*" required>
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
    </div>
@endsection
