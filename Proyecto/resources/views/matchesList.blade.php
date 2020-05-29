@extends('layouts.master')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/styles.css')}}">
    <div class="overflowPers text-white justify-content-center margenCajaPartidos34">
        <div class="col-md-12">
            <h1 class="fuenteTitulo text-center mt-3 mb-1 backGroundCabeceras">Partidos</h1>

            <div class="row">
                <div class="col-md-2 col-sm-12 mt-5 justify-content-start ml-5" style="margin-right: 8%">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="selectCompeticiones">Escoja competición:</label>
                            <select class="form-control text-white bg-info" style="width: 350px" id="selectCompeticiones" name="selectCompeticiones">
                                @foreach($ligas as $liga)
                                    @if(isset($ligaSeleccionada))
                                        @if($ligaSeleccionada==$liga->id)
                                            <option value="{{$liga->id}}" selected="selected">{{$liga->name}}</option>
                                        @else
                                            <option value="{{$liga->id}}">{{$liga->name}}</option>
                                        @endif
                                        @else
                                        <option value="{{$liga->id}}">{{$liga->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                            <label for="selectEquipos">Escoja equipo:</label>
                            <select class="form-control text-white bg-info" style="width: 350px" id="selectEquipos" name="selectEquipos">
                                @foreach($equipos as $equipo)
                                    @if(isset($equipoSeleccionado))
                                        @if($equipoSeleccionado==$equipo->id)
                                            <option value="{{$equipo->id}}" selected="selected">{{$equipo->name}}</option>
                                        @else
                                            <option value="{{$equipo->id}}">{{$equipo->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$equipo->id}}">{{$equipo->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                            <label for="selectEstadio">Escoja estadio:</label>
                            <select class="form-control text-white bg-info" style="width: 350px" id="selectEstadio" name="selectEstadio">
                                @if(isset($estadioSeleccionado))
                                    @if($estadioSeleccionado=="Todos")
                                        <option selected="selected">Todos</option>
                                        <option>Local</option>
                                        <option>Visitante</option>
                                    @endif
                                    @if($estadioSeleccionado=="Local")
                                        <option>Todos</option>
                                        <option selected="selected">Local</option>
                                        <option>Visitante</option>
                                    @endif
                                    @if($estadioSeleccionado=="Visitante")
                                        <option>Todos</option>
                                        <option>Local</option>
                                        <option selected="selected">Visitante</option>
                                    @endif
                                @else
                                    <option>Todos</option>
                                    <option>Local</option>
                                    <option>Visitante</option>
                                @endif

                            </select>
                            <label for="selectJornada">Escoja jornada:</label>
                            <select class="form-control text-white bg-info" style="width: 350px" id="selectJornada" name="selectJornada">
                                <option>Todas</option>
                                @foreach($jornadas as $jornada)
                                    @if(isset($jornadaSeleccionada))
                                        @if($jornadaSeleccionada==$jornada->journey)
                                            <option selected="selected">{{$jornada->journey}}</option>
                                        @else
                                            <option>{{$jornada->journey}}</option>
                                        @endif
                                    @else
                                        <option>{{$jornada->journey}}</option>
                                    @endif
                                @endforeach

                            </select>
                            <button class="btn btn-light mt-3" type="submit" name="filtrar">Filtrar</button>
                        </div>
                    </form>
                    @if(Auth()->check())
                        @if(Auth()->user()->role=="Administrador")
                            <a href="{{url('/addMatch/false')}}"><button class="btn btn-success mb-4" type="submit" name="filtrar">Añadir Partido</button></a>
                        @endif
                    @endif
                </div>
                <div class="col-md-8 col-sm-12 table-responsive ml-5 mt-5 cajaM" style="max-height: 513px !important;">
                    <table class="table table-bordered fuenteBlanca mt-5" style="border:3px solid aqua;border-radius:10px">
                        <thead class="thead-light">
                        <tr class="text-center">
                            <th scope="col">Jornada</th>
                            <th scope="col" colspan="2">Local</th>
                            <th scope="col" colspan="3">Resultado</th>
                            <th scope="col" colspan="2">Visitante</th>
                            <th scope="col">Edición</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($arrayPartidos))

                            @foreach($arrayPartidos as $key =>$partido)
                                <tr class="text-center">
                                    <td>{{$partido->journey}}</td>

                                    @if($partido->id_team_local!=$idMadrid)
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($infoContrincantes[$key][0]->image)}}"></td>
                                        <td>{{$infoContrincantes[$key][0]->name}}</td>
                                    @else
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($partido->image)}}"></td>
                                        <td>{{$partido->name}}</td>
                                    @endif
                                    <td style="font-size: 30px;min-width: 98px;" colspan="3">{{$partido->score_local}} - {{$partido->score_visitor}}</td>
                                    @if($partido->id_team_visitor!=$idMadrid)
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($infoContrincantes[$key][0]->image)}}"></td>
                                        <td>{{$infoContrincantes[$key][0]->name}}</td>
                                    @else
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($partido->image)}}"></td>
                                        <td>{{$partido->name}}</td>
                                    @endif

                                    <td>
                                        <form action="{{url('/editMatch')}}" method="POST" name="editarPartidoList">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="{{$arrayPartidos[$key]->id}}" name="guardarIdPartidoEditar">
                                            @if(Auth()->check())
                                                @if(Auth()->user()->role=="Administrador")
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                @else
                                                    <button type="submit" class="btn btn-warning disabled" disabled>Editar</button>
                                                @endif
                                            @else
                                                <button type="submit" class="btn btn-warning disabled" disabled>Editar</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if(isset($partidosLigaLocal))
                            @foreach($partidosLigaLocal as $key =>$partido)
                                <tr class="text-center">
                                    <td>{{$partido->journey}}</td>

                                    @if($partido->id_team_local!=$equipoSeleccionado)
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($infoContrincantes[$key][0]->image)}}"></td>
                                        <td>{{$infoContrincantes[$key][0]->name}}</td>
                                    @else
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($partido->image)}}"></td>
                                        <td>{{$partido->name}}</td>
                                    @endif
                                    <td style="font-size: 30px;min-width: 98px;" colspan="3">{{$partido->score_local}} - {{$partido->score_visitor}}</td>
                                    @if($partido->id_team_visitor!=$equipoSeleccionado)
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($infoContrincantes[$key][0]->image)}}"></td>
                                        <td>{{$infoContrincantes[$key][0]->name}}</td>
                                    @else
                                        <td class="text-center" style="min-width: 75px"><img alt="teamImageLocal" class="tamanioFotoClubTabla" src="{{asset($partido->image)}}"></td>
                                        <td>{{$partido->name}}</td>
                                    @endif

                                    <td>
                                        <form action="{{url('/editMatch')}}" method="POST" name="editarPartidoList">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="{{$partidosLigaLocal[$key]->id}}" name="guardarIdPartidoEditar">
                                            @if(Auth()->check())
                                                @if(Auth()->user()->role=="Administrador")
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                @else
                                                    <button type="submit" class="btn btn-warning disabled" disabled>Editar</button>
                                                @endif
                                            @else
                                                <button type="submit" class="btn btn-warning disabled" disabled>Editar</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection