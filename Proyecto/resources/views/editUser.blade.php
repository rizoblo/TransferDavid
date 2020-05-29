@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <h1 class="fuenteTitulo text-center mt-5 mb-5">Datos del Usuario</h1>
    <div class="container w-50">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="fuenteBlanca">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value=" {{ $user->name }}" placeholder="{{ $user->name }}" maxlength="30" style="width:40% !important">
            </div>
            <div class="form-group">
                <label for="last_name" class="fuenteBlanca">Apellido 1</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value=" {{ $user->last_name }}" placeholder="{{ $user->last_name }}" maxlength="30" style="width:40% !important">
            </div>
            <div class="form-group">
                <label for="last_name2" class="fuenteBlanca">Apellido 2</label>
                <input type="text" class="form-control" name="last_name2" id="last_name2" value=" {{ $user->last_name2 }}" placeholder="{{ $user->last_name2 }}" maxlength="30" style="width:40% !important">
            </div>
            <div class="form-group">
                <label for="email" class="fuenteBlanca">Email address</label>
                <input type="email" class="form-control" name="email" value=" {{ $user->email }} " id="email" placeholder="{{ $user->email }}" maxlength="60" style="width:73% !important">
            </div>
            <div class="form-group">
                <label for="passActual" class="fuenteBlanca">Contraseña Actual *Rellene este campo si desea cambiar la contraseña*</label>
                <input type="password" class="form-control @error('passActual') is-invalid @enderror" maxlength="70" style="width:48% !important" id="passActual" name="passActual">
                @error('passActual')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="Contraseña1" class="fuenteBlanca">Nueva contraseña</label>
                <input type="password" class="form-control @error('Contraseña1') is-invalid @enderror" name="Contraseña1" id="Contraseña1" maxlength="70" style="width:48% !important">
                @error('Contraseña1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="Contraseña2" class="fuenteBlanca">Repita contraseña</label>
                <input type="password" class="form-control" name="Contraseña2" id="Contraseña2" maxlength="70" style="width:48% !important">
            </div>
            <div class="form-group">
                <label for="fav_team" class="fuenteBlanca">Equipo favorito</label>
                <select class="form-control" style="width:30% !important" id="fav_team" name="fav_team">
                    @foreach($teams as $team)
                        @if($team->id == $user->fav_team)
                            <option value="{{$team->id}}" selected="selected">{{$team->name}}</option>
                        @else
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role" class="fuenteBlanca">Rol</label>
                <select class="form-control" style="width:27% !important" id="role" name="role">
                    @if($variable=="noAdmin")
                        @if(Auth()->user()->role == "Estándar")
                            <option value="Estándar" selected="selected">Estándar</option>
                        @endif
                        @if(Auth()->user()->role == "Creador")
                            <option value="Creador" selected="selected">Creador</option>
                        @endif
                        @if(Auth()->user()->role == "Administrador")
                            <option value="Administrador" selected="selected">Administrador</option>
                        @endif
                    @else
                        @if($user->role=="Estándar")
                            <option value="Estándar" selected="selected">Estándar</option>
                            <option value="Creador">Creador</option>
                            <option value="Administrador">Administrador</option>
                        @endif
                        @if($user->role=="Creador")
                            <option value="Estándar">Estándar</option>
                            <option value="Creador" selected="selected">Creador</option>
                            <option value="Administrador">Administrador</option>
                        @endif
                        @if($user->role=="Administrador")
                            <option value="Estándar">Estándar</option>
                            <option value="Creador">Creador</option>
                            <option value="Administrador" selected="selected">Administrador</option>
                        @endif
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="user_description" class="fuenteBlanca">Descripción del Usuario</label>
                <textarea class="form-control" name="user_description" id="user_description" rows="3" value=" {{ $user->user_description }}" maxlength="200" required>{{ $user->user_description }}</textarea>
            </div>
            <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
        </form>
        <br>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger" name="eliminar">Eliminar Cuenta</button>
        </form>
    </div>
@endsection
