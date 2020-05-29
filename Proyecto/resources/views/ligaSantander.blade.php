@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="col-md-12 text-center text-light">
        <h1 class="fuenteTitulo mt-5 mb-5 backGroundCabeceras"><img alt="leagueImage" style="border-radius: 10%" src="../images/ligas/santander.png"> Liga Santander</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 mt-3 text-left justify-content-start" >
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="selectCompeticiones">Seleccione temporada:</label>
                                <select class="form-control text-white bg-info" style="width: 350px" id="selectCompeticiones" name="selectCompeticiones" value="{{old('selectCompeticiones')}}">
                                    @foreach($ligas as $liga)
                                        @if($ligaSeleccionada==$liga->id)
                                            <option value="{{$liga->id}}" selected="selected">{{$liga->name}}</option>
                                        @else
                                            <option value="{{$liga->id}}">{{$liga->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="btn btn-light mt-3" type="submit" name="filtrar">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-3 margenCP">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered fuenteBlanca ">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Posición</th>
                                <th scope="col" colspan="2">Club</th>
                                <th scope="col">PJ</th>
                                <th scope="col">V</th>
                                <th scope="col">E</th>
                                <th scope="col">D</th>
                                <th scope="col">GF</th>
                                <th scope="col">GC</th>
                                <th scope="col">DG</th>
                                <th scope="col">Puntos</th>
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($partidosLiga as $partido)
                                        <tr>
                                            <th scope="row">{{$contador=$contador +1}}</th>
                                            <td class="text-center" style="min-width: 75px"><img alt="teamImage" class="tamanioFotoClubTabla" src="{{asset($partido->image)}}"></td>
                                            <td>{{$partido->name}}</td>
                                            <td>{{$partido->pj}}</td>
                                            <td>{{$partido->v}}</td>
                                            <td>{{$partido->e}}</td>
                                            <td>{{$partido->d}}</td>
                                            <td>{{$partido->gf}}</td>
                                            <td>{{$partido->gc}}</td>
                                            <td>{{$partido->dg}}</td>
                                            <td>{{$partido->points}}</td>
                                        </tr>
                                    @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection