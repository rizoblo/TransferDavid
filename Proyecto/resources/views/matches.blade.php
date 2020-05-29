@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="container overflowPers margenCP4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5 estilosCajaEquipoMatches estiloCajaIzquierda">
                    <a href="{{url('/matches/madrid')}}"><img class="img-fluid estilosImagenEquipoMatchesMadrid" style="height: 100%; width: 100%" src="{{asset('images/fondos/matches-madrid.jpg')}}"></a>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5 estilosCajaEquipoMatches estiloCajaDerecha">
                    <a href="{{url('/matches/barcelona')}}"><img class="img-fluid estilosImagenEquipoMatchesBarcelona" style="height: 100%; width: 100%" src="{{asset('images/fondos/matches-barcelona.jpg')}}"></a>
                </div>
            </div>
        </div>
    </div>
@endsection