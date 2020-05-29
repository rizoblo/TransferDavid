@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="col-md-12 text-center">
        <h1 class="fuenteTitulo mt-5 mb-5 backGroundCabeceras"><img style="border-radius: 10%" src="images/ligas/serieA.png"> Serie A</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="row mt-3">
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="text-center" style="min-width: 75px"><img class="tamanioFotoClubTabla" src="images/clubes/athletic.png"></td>
                                    <td>Athletic Club de Bilbao</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td class="text-center">Otto</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection