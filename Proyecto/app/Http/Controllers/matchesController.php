<?php

namespace App\Http\Controllers;

use App\League;
use App\Match;
use App\Participate;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Array_;

class matchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function devolverCabecera()
    {
        $ligas = DB::table('leagues')
            ->where('name', 'like', '%Espa%')->get();
        $equipos=Team::all();
        $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
        $idMadrid=$idMadridArray[0]->id;

        $partidosLigaLocal = DB::table('matches')
            ->join('teams', 'matches.id_team_local', '=', 'teams.id')
            ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $idMadrid)->where('matches.id_league', '=' , "1")
            ->get();

        $partidosLigaVisitante = DB::table('matches')
            ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
            ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $idMadrid)->where('matches.id_league', '=' , "1")
            ->get();

        $arrayPartidos=array();

        //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

        foreach($partidosLigaLocal as $key => $value) {
            $arrayPartidos[] = $value;
        }
        foreach($partidosLigaVisitante as $key => $value) {
            $arrayPartidos[] = $value;
        }
        //

        //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
        //return $arrayPartidos;
        foreach($arrayPartidos as $key =>$value){
            $aux=0;
            if($key==0){
                $journeyMenor=$value->journey;
            }else{
                for($i=$key;$i>0;$i--){
                    if($value->journey<$arrayPartidos[$i-1]->journey){
                        $aux=$arrayPartidos[$i-1];
                        $arrayPartidos[$i-1]=$value;
                        $arrayPartidos[$i]=$aux;
                    }
                }
            }
        }

        //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL MADRID EN TODOS LOS PARTIDOS

        $arrayNombresEImagenesOtrosEquipos=array();

        foreach ($arrayPartidos as $key => $value){
            if($value->id_team_local!=$idMadrid) {
                $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
            }
            if($value->id_team_visitor!=$idMadrid){
                $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
            }

        }
        $infoContrincantes=array();
        foreach ($arrayNombresEImagenesOtrosEquipos as $value){
            $infoContrincantes[] = DB::table('teams')
                ->select('name', 'image')->where('id', '=' , "$value")
                ->get();
        }

        $jornadas = DB::table('matches')
            ->select('journey')->distinct('journey')->get();
        //return $arrayPartidos;
        //            return view('matchesList')->with('ligas',$ligas)->with('idMadrid',$idMadrid)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('equipoSeleccionado',$equipoSeleccionado);
        return view('matchesList')->with('ligas',$ligas)->with('infoContrincantes',$infoContrincantes)->with('idMadrid',$idMadrid)->with('equipos',$equipos)->with('arrayPartidos',$arrayPartidos)->with('jornadas',$jornadas);
    }

    public function devolverAddMatch(Request $request)
    {
        if($request->route('fallo')=="true"){
            $fallo=true;
            $ligas=League::all();
            $equipos=Team::all();

            return view('addMatch')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
        }else{
            $fallo=false;
            $ligas=League::all();
            $equipos=Team::all();

            return view('addMatch')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
        }
    }

    public function devolverPartidos(Request $request)
    {

        $ligaSeleccionada=$request->input('selectCompeticiones');
        $equipoSeleccionado=$request->input('selectEquipos');
        $estadioSeleccionado=$request->input('selectEstadio');
        $jornadaSeleccionada=$request->input('selectJornada');
        //$idMadrid=DB::select("select id from teams where name='Real Madrid C.F'");
        $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
        $idMadrid=$idMadridArray[0]->id;
        //$ligas=League::all();
        $ligas = DB::table('leagues')
            ->where('name', 'like', '%Espa%')->get();
        $equipos=Team::all();

        //PARTIDOS DEL EQUIPO DE LOCAL

        if($estadioSeleccionado=="Local"){
            if($jornadaSeleccionada!="Todas"){
                $partidosLigaLocal = DB::table('matches')
                    ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")->where('matches.journey', '=' , "$jornadaSeleccionada")
                    ->get();
                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);

            }
            if($jornadaSeleccionada=="Todas"){
                $partidosLigaLocal = DB::table('matches')
                    ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")
                    ->get();
                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);
            }
        }

        /*$partidosLigaLocal = DB::table('matches')
            ->join('teams', 'matches.id_team_local', '=', 'teams.id')
            ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "$ligaSeleccionada")
            ->get();*/

        //PARTIDOS DEL EQUIPO DE VISITANTE

        if($estadioSeleccionado=="Visitante"){
            if($jornadaSeleccionada!="Todas"){
                $partidosLigaLocal = DB::table('matches')
                    ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")->where('matches.journey', '=' , "$jornadaSeleccionada")
                    ->get();
                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);

            }
            if($jornadaSeleccionada=="Todas"){
                $partidosLigaLocal = DB::table('matches')
                    ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")
                    ->get();
                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);
            }
        }
        if($estadioSeleccionado=="Todos") {
            if($jornadaSeleccionada!="Todas"){
                $partidosLigaLocal1 = DB::table('matches')
                    ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")->where('matches.journey', '=' , "$jornadaSeleccionada")
                    ->get();
                $partidosLigaLocal2 = DB::table('matches')
                    ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")->where('matches.journey', '=' , "$jornadaSeleccionada")
                    ->get();

                $partidosLigaLocal=array();

                //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

                foreach($partidosLigaLocal1 as $key => $value) {
                    $partidosLigaLocal[] = $value;
                }
                foreach($partidosLigaLocal2 as $key => $value) {
                    $partidosLigaLocal[] = $value;
                }
                //


                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);

            }
            if($jornadaSeleccionada=="Todas"){
                $partidosLigaLocal1 = DB::table('matches')
                    ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")
                    ->get();
                $partidosLigaLocal2 = DB::table('matches')
                    ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=' , $equipoSeleccionado)->where('matches.id_league', '=' , "$ligaSeleccionada")
                    ->get();

                $partidosLigaLocal=array();

                //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

                foreach($partidosLigaLocal1 as $key => $value) {
                    $partidosLigaLocal[] = $value;
                }
                foreach($partidosLigaLocal2 as $key => $value) {
                    $partidosLigaLocal[] = $value;
                }
                //


                //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA

                foreach($partidosLigaLocal as $key =>$value){
                    $aux=0;
                    if($key==0){
                        $journeyMenor=$value->journey;
                    }else{
                        for($i=$key;$i>0;$i--){
                            if($value->journey<$partidosLigaLocal[$i-1]->journey){
                                $aux=$partidosLigaLocal[$i-1];
                                $partidosLigaLocal[$i-1]=$value;
                                $partidosLigaLocal[$i]=$aux;
                            }
                        }
                    }
                }
                //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL EQUIPO EN CUESTION EN TODOS LOS PARTIDOS

                $arrayNombresEImagenesOtrosEquipos=array();

                foreach ($partidosLigaLocal as $key => $value){
                    if($value->id_team_local!=$equipoSeleccionado) {
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                    }
                    if($value->id_team_visitor!=$equipoSeleccionado){
                        $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                    }

                }
                $infoContrincantes=array();
                foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                    $infoContrincantes[] = DB::table('teams')
                        ->select('name', 'image')->where('id', '=' , "$value")
                        ->get();
                }
                $jornadas = DB::table('matches')
                    ->select('journey')->distinct('journey')->get();
                return view('matchesList')->with('equipoSeleccionado',$equipoSeleccionado)->with('ligas',$ligas)->with('jornadas',$jornadas)->with('equipos',$equipos)->with('partidosLigaLocal',$partidosLigaLocal)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado)->with('estadioSeleccionado',$estadioSeleccionado)->with('jornadaSeleccionada',$jornadaSeleccionada);
            }
        }

        //PARTIDOS DEL EQUIPO DE LOCAL Y VISITANTE
        /*
        $partidosLigaVisitante = DB::table('matches')
            ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
            ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "$ligaSeleccionada")
            ->get();


        $arrayPartidos=array();

        //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

        foreach($partidosLigaLocal as $key => $value) {
            $arrayPartidos[] = $value;
        }
        foreach($partidosLigaVisitante as $key => $value) {
            $arrayPartidos[] = $value;
        }

        //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
        //DE SI EL MADRID JUGO DE LOCAL O VISITANTE


        foreach($arrayPartidos as $key =>$value){
            $aux=0;
            if($key==0){
                $journeyMenor=$value->journey;
            }else{
                for($i=$key;$i>0;$i--){
                    if($value->journey<$arrayPartidos[$i-1]->journey){
                        $aux=$arrayPartidos[$i-1];
                        $arrayPartidos[$i-1]=$value;
                        $arrayPartidos[$i]=$aux;
                    }
                }
            }
        }

        //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL MADRID EN TODOS LOS PARTIDOS

        $arrayNombresEImagenesOtrosEquipos=array();

        foreach ($arrayPartidos as $key => $value){
            if($value->id_team_local!=$idMadrid) {
                $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
            }
            if($value->id_team_visitor!=$idMadrid){
                $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
            }

        }
        $infoContrincantes=array();
        foreach ($arrayNombresEImagenesOtrosEquipos as $value){
            $infoContrincantes[] = DB::table('teams')
                ->select('name', 'image')->where('id', '=' , "$value")
                ->get();
        }*/

        //return view('matchesList')->with('ligas',$ligas)->with('idMadrid',$idMadrid)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado);



    }


    public function recibirAddMatch(Request $request)
    {
            $partido = new Match();
            $partido->id_team_local = $request->input('localTeamAddMatch');
            $partido->id_team_visitor = $request->input('visitorTeamAddMatch');
            $partido->id_league = $request->input('league');
            $partido->journey = $request->input('journey');
            $partido->score_local = $request->input('scoreLocal');
            $partido->score_visitor = $request->input('scoreVisitor');

            //COMPROBANDO SI EXISTE ESA JORNADA DE ESE EQUIPO EN ESA LIGA

            //COMPROBANDO SI EXISTE ESE PARTIDO PARA EL EQUIPO LOCAL

            $partidosLigaDelLocalComoLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $request->input('localTeamAddMatch'))->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();
            $partidosLigaDelLocalComoVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $request->input('localTeamAddMatch'))->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();

            //COMPROBANDO SI EXISTE ESE PARTIDO PARA EL EQUIPO VISITANTE

            $partidosLigaDelVisitanteComoLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $request->input('visitorTeamAddMatch'))->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();
            $partidosLigaDelVisitanteComoVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.id', '=', $request->input('visitorTeamAddMatch'))->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();

            //return $partidosLigaVisitante;

            //SI EL PARTIDO EXISTE YA PARA ALGUNO DE LOS DOS EQUIPOS, REDIRIJE A LA VISTA CON EL ERROR PARA QUE USUARIO VEA QUE EL PARTIDO YA EXISTE, EN CASO CONTRARIO EL PARTIDO
            //SE GUARDARÁ

            if(isset($partidosLigaDelLocalComoLocal) || isset($partidosLigaDelLocalComoVisitante) || isset($partidosLigaDelVisitanteComoLocal) || isset($partidosLigaDelVisitanteComoVisitante)){
                $partidoLocal="";
                $partidoVisitante="";
                $existenciaPartido="neutro";
                $ligas=League::all();
                $equipos=Team::all();
                if(isset($partidosLigaDelLocalComoLocal) || isset($partidosLigaDelLocalComoVisitante)){
                    $partidoLocal="localExiste";
                }
                if(isset($partidosLigaDelVisitanteComoLocal) || isset($partidosLigaDelVisitanteComoVisitante)){
                    $partidoVisitante="visitanteExiste";
                    
                }
                if($partidoLocal!="" && $partidoVisitante==""){
                    $existenciaPartido="localExiste";
                    return view('addMatch')->with('existenciaPartido',$existenciaPartido)->with('equipos',$equipos)->with('ligas',$ligas); 
                }
                if($partidoLocal=="" && $partidoVisitante!=""){
                    $existenciaPartido="visitanteExiste";
                    return view('addMatch')->with('existenciaPartido',$existenciaPartido)->with('equipos',$equipos)->with('ligas',$ligas); 
                }
                if($partidoLocal!="" && $partidoVisitante!=""){
                    $existenciaPartido="ambosExisten";
                    return view('addMatch')->with('existenciaPartido',$existenciaPartido)->with('equipos',$equipos)->with('ligas',$ligas);
                }
                //return "partido no disponible";
            }else{

                //CALCULO DE ESTADISTICAS

                $participacionYaEditadaLocal = false;
                $participacionYaEditadaVisitante = false;

                //BUSCAMOS LA PARTICIPACION DE AMBOS EQUIPOS EN ESA LIGA, Y SI NO EXISTEN EN ESA LIGA, LAS CREAMOS

                $participacionLocal = DB::table('participates')
                    ->where('id_team', '=', $request->input('localTeamAddMatch'))->where('id_league', '=', $request->input('league'))->first();

                $participacionVisitante = DB::table('participates')
                    ->where('id_team', '=', $request->input('visitorTeamAddMatch'))->where('id_league', '=', $request->input('league'))->first();

                if (isset($participacionLocal)) {
                    $participacionAEditarLocal = Participate::findOrFail($participacionLocal->id);
                    //return "la participacion del local existe";
                }
                if (!isset($participacionLocal)) {
                    //return "la participacion del local no existe";
                    $participacionNuevaLocal = new Participate();
                    $participacionNuevaLocal->id_league = $request->input('league');
                    $participacionNuevaLocal->id_team = $request->input('localTeamAddMatch');
                    $participacionNuevaLocal->pj = 1;
                    if($request->input('scoreLocal') > $request->input('scoreVisitor')){
                        $participacionNuevaLocal->v = 1;
                        $participacionNuevaLocal->d = 0;
                        $participacionNuevaLocal->e = 0;
                        $participacionNuevaLocal->points = 3;
                    }
                    if($request->input('scoreLocal') < $request->input('scoreVisitor')){
                        $participacionNuevaLocal->v = 0;
                        $participacionNuevaLocal->d = 1;
                        $participacionNuevaLocal->e = 0;
                        $participacionNuevaLocal->points = 0;
                    }
                    if($request->input('scoreLocal') == $request->input('scoreVisitor')){
                        $participacionNuevaLocal->v = 0;
                        $participacionNuevaLocal->d = 0;
                        $participacionNuevaLocal->e = 1;
                        $participacionNuevaLocal->points = 1;
                    }
                    $participacionNuevaLocal->gf = $request->input('scoreLocal');
                    $participacionNuevaLocal->gc = $request->input('scoreVisitor');
                    $participacionNuevaLocal->dg = $request->input('scoreLocal') - $request->input('scoreVisitor');
                    $participacionNuevaLocal->save();
                    $participacionYaEditadaLocal = true;
                }
                if (isset($participacionVisitante)) {
                    $participacionAEditarVisitante = Participate::findOrFail($participacionVisitante->id);
                    //return "la participacion del visitante existe";
                }
                if (!isset($participacionVisitante)) {
                    //return "la participacion del visitante no existe";
                    $participacionNuevaVisitante = new Participate();
                    $participacionNuevaVisitante->id_league = $request->input('league');
                    $participacionNuevaVisitante->id_team = $request->input('visitorTeamAddMatch');
                    $participacionNuevaVisitante->pj = 1;
                    if($request->input('scoreLocal') > $request->input('scoreVisitor')){
                        $participacionNuevaVisitante->v = 0;
                        $participacionNuevaVisitante->d = 1;
                        $participacionNuevaVisitante->e = 0;
                        $participacionNuevaVisitante->points = 0;
                    }
                    if($request->input('scoreLocal') < $request->input('scoreVisitor')){
                        $participacionNuevaVisitante->v = 1;
                        $participacionNuevaVisitante->d = 0;
                        $participacionNuevaVisitante->e = 0;
                        $participacionNuevaVisitante->points = 3;
                    }
                    if($request->input('scoreLocal') == $request->input('scoreVisitor')){
                        $participacionNuevaVisitante->v = 0;
                        $participacionNuevaVisitante->d = 0;
                        $participacionNuevaVisitante->e = 1;
                        $participacionNuevaVisitante->points = 1;
                    }
                    $participacionNuevaVisitante->gf = $request->input('scoreVisitor');
                    $participacionNuevaVisitante->gc = $request->input('scoreLocal');
                    $participacionNuevaVisitante->dg = $request->input('scoreVisitor') - $request->input('scoreLocal');
                    $participacionNuevaVisitante->save();
                    $participacionYaEditadaVisitante = true;
                }

                //AJUSTE ESTADISTICAS LOCAL SI NO HAN SIDO AUN ACTUALIZADAS

                if ($participacionYaEditadaLocal == false) {

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditarLocal->pj = $participacionAEditarLocal->pj + 1;

                    //CALCULAMOS SI EL EQUIPO LOCAL GANA, O PIERDE, O EMPATA EN EL NUEVO PARTIDO

                    //EL NUEVO RESULTADO HACE QUE EL LOCAL GANE
                    if ($request->input('scoreLocal') > $request->input('scoreVisitor')) {
                        $participacionAEditarLocal->v = $participacionAEditarLocal->v + 1;
                        //CALCULO DE PUNTOS
                        $participacionAEditarLocal->points = $participacionAEditarLocal->points + 3;
                    }
                    //EL NUEVO RESULTADO HACE QUE EL LOCAL PIERDA
                    if ($request->input('scoreLocal') < $request->input('scoreVisitor')) {
                        $participacionAEditarLocal->d = $participacionAEditarLocal->d + 1;
                        //CALCULO DE PUNTOS
                        //(NO SE SUMAN PUNTOS)
                    }
                    //EL NUEVO RESULTADO HACE QUE EL LOCAL EMPATE
                    if ($request->input('scoreLocal') == $request->input('scoreVisitor')) {
                        $participacionAEditarLocal->e = $participacionAEditarLocal->e + 1;
                        //CALCULO DE PUNTOS
                        $participacionAEditarLocal->points = $participacionAEditarLocal->points + 1;
                    }

                    //CALCULO DE GOLES

                    $participacionAEditarLocal->gf = $participacionAEditarLocal->gf + $request->input('scoreLocal');
                    $participacionAEditarLocal->gc = $participacionAEditarLocal->gc + $request->input('scoreVisitor');
                    $participacionAEditarLocal->dg = $participacionAEditarLocal->gf - $participacionAEditarLocal->gc;

                    //EDICION
                    $participacionAEditarLocal->save();
                    //return $participacionAEditar;
                }

                //AJUSTE ESTADISTICAS VISITANTE SI NO HAN SIDO AUN ACTUALIZADAS

                if ($participacionYaEditadaVisitante == false) {

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditarVisitante->pj = $participacionAEditarVisitante->pj + 1;

                    //CALCULAMOS SI EL EQUIPO VISITANTE GANA, O PIERDE, O EMPATA EN EL NUEVO PARTIDO

                    //EL NUEVO RESULTADO HACE QUE EL VISITANTE GANE
                    if ($request->input('scoreLocal') < $request->input('scoreVisitor')) {
                        $participacionAEditarVisitante->v = $participacionAEditarVisitante->v + 1;
                        //CALCULO DE PUNTOS
                        $participacionAEditarVisitante->points = $participacionAEditarVisitante->points + 3;
                    }
                    //EL NUEVO RESULTADO HACE QUE EL VISITANTE PIERDA
                    if ($request->input('scoreLocal') > $request->input('scoreVisitor')) {
                        $participacionAEditarVisitante->d = $participacionAEditarVisitante->d + 1;
                        //CALCULO DE PUNTOS
                        //(NO SE SUMAN PUNTOS)
                    }
                    //EL NUEVO RESULTADO HACE QUE EL VISITANTE EMPATE
                    if ($request->input('scoreLocal') == $request->input('scoreVisitor')) {
                        $participacionAEditarVisitante->e = $participacionAEditarVisitante->e + 1;
                        //CALCULO DE PUNTOS
                        $participacionAEditarVisitante->points = $participacionAEditarVisitante->points + 1;
                    }

                    //CALCULO DE GOLES

                    $participacionAEditarVisitante->gf = $participacionAEditarVisitante->gf + $request->input('scoreVisitor');
                    $participacionAEditarVisitante->gc = $participacionAEditarVisitante->gc + $request->input('scoreLocal');
                    $participacionAEditarVisitante->dg = $participacionAEditarVisitante->gf - $participacionAEditarVisitante->gc;

                    //EDICION
                    $participacionAEditarVisitante->save();

                }

                $partido->save();
                return redirect('/matches');
                //return "partido disponible";
            }

    }






    /*public function devolverPartidosInicial(Request $request)
    {
        $equipoSeleccionado=$request->route('team');
        if($equipoSeleccionado=="madrid"){
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();
            //PARTIDOS DEL MADRID DE LOCAL

            //$idMadridArray=DB::select("select id from teams where name='Real Madrid C.F'");
            $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
            $idMadrid=$idMadridArray[0]->id;

            $partidosLigaLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "1")
                ->get();

            //PARTIDOS DEL MADRID DE VISITANTE

            $partidosLigaVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "1")
                ->get();


            $arrayPartidos=array();

            //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

            foreach($partidosLigaLocal as $key => $value) {
                $arrayPartidos[] = $value;
            }
            foreach($partidosLigaVisitante as $key => $value) {
                $arrayPartidos[] = $value;
            }

            //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
            //DE SI EL MADRID JUGO DE LOCAL O VISITANTE


            foreach($arrayPartidos as $key =>$value){
                $aux=0;
                if($key==0){
                    $journeyMenor=$value->journey;
                }else{
                    for($i=$key;$i>0;$i--){
                        if($value->journey<$arrayPartidos[$i-1]->journey){
                            $aux=$arrayPartidos[$i-1];
                            $arrayPartidos[$i-1]=$value;
                            $arrayPartidos[$i]=$aux;
                        }
                    }
                }
            }

            //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL MADRID EN TODOS LOS PARTIDOS

            $arrayNombresEImagenesOtrosEquipos=array();

            foreach ($arrayPartidos as $key => $value){
                if($value->id_team_local!=$idMadrid) {
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                }
                if($value->id_team_visitor!=$idMadrid){
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                }

            }
            $infoContrincantes=array();
            foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                $infoContrincantes[] = DB::table('teams')
                    ->select('name', 'image')->where('id', '=' , "$value")
                    ->get();
            }

            return view('matchesList')->with('ligas',$ligas)->with('idMadrid',$idMadrid)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('equipoSeleccionado',$equipoSeleccionado);
        }
        if($equipoSeleccionado=="barcelona"){
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();
            //PARTIDOS DEL BARCELONA DE LOCAL

            //$idBarcelona=DB::select("select id from teams where name='F.C Barcelona'");
            $idBarcelonaArray=DB::table('teams')->select('id')->where('name','=','F.C Barcelona')->get();
            $idBarcelona=$idBarcelonaArray[0]->id;

            $partidosLigaLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "F.C Barcelona")->where('matches.id_league', '=' , "1")
                ->get();

            //PARTIDOS DEL BARCELONA DE VISITANTE

            $partidosLigaVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "F.C Barcelona")->where('matches.id_league', '=' , "1")
                ->get();


            $arrayPartidos=array();

            //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

            foreach($partidosLigaLocal as $key => $value) {
                $arrayPartidos[] = $value;
            }
            foreach($partidosLigaVisitante as $key => $value) {
                $arrayPartidos[] = $value;
            }

            //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
            //DE SI EL MADRID JUGO DE LOCAL O VISITANTE


            foreach($arrayPartidos as $key =>$value){
                $aux=0;
                if($key==0){
                    $journeyMenor=$value->journey;
                }else{
                    for($i=$key;$i>0;$i--){
                        if($value->journey<$arrayPartidos[$i-1]->journey){
                            $aux=$arrayPartidos[$i-1];
                            $arrayPartidos[$i-1]=$value;
                            $arrayPartidos[$i]=$aux;
                        }
                    }
                }
            }

            //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL BARCELONA EN TODOS LOS PARTIDOS

            $arrayNombresEImagenesOtrosEquipos=array();

            foreach ($arrayPartidos as $key => $value){
                if($value->id_team_local!=$idBarcelona) {
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                }
                if($value->id_team_visitor!=$idBarcelona){
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                }

            }
            $infoContrincantes=array();
            foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                $infoContrincantes[] = DB::table('teams')
                    ->select('name', 'image')->where('id', '=' , "$value")
                    ->get();
            }

            return view('matchesList')->with('ligas',$ligas)->with('idBarcelona',$idBarcelona)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('equipoSeleccionado',$equipoSeleccionado);
        }

    }*/
    /*public function devolverPartidos(Request $request)
    {

        $equipoSeleccionado=$request->route('team');
        if($equipoSeleccionado=="madrid"){
            $ligaSeleccionada=$request->input('selectCompeticiones');
            //$idMadrid=DB::select("select id from teams where name='Real Madrid C.F'");
            $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
            $idMadrid=$idMadridArray[0]->id;
            //$ligas=League::all();
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();

            //PARTIDOS DEL MADRID DE LOCAL

            $partidosLigaLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "$ligaSeleccionada")
                ->get();

            //PARTIDOS DEL MADRID DE VISITANTE

            $partidosLigaVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "Real Madrid C.F")->where('matches.id_league', '=' , "$ligaSeleccionada")
                ->get();


            $arrayPartidos=array();

            //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

            foreach($partidosLigaLocal as $key => $value) {
                $arrayPartidos[] = $value;
            }
            foreach($partidosLigaVisitante as $key => $value) {
                $arrayPartidos[] = $value;
            }

            //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
            //DE SI EL MADRID JUGO DE LOCAL O VISITANTE


            foreach($arrayPartidos as $key =>$value){
                $aux=0;
                if($key==0){
                    $journeyMenor=$value->journey;
                }else{
                    for($i=$key;$i>0;$i--){
                        if($value->journey<$arrayPartidos[$i-1]->journey){
                            $aux=$arrayPartidos[$i-1];
                            $arrayPartidos[$i-1]=$value;
                            $arrayPartidos[$i]=$aux;
                        }
                    }
                }
            }

            //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL MADRID EN TODOS LOS PARTIDOS

            $arrayNombresEImagenesOtrosEquipos=array();

            foreach ($arrayPartidos as $key => $value){
                if($value->id_team_local!=$idMadrid) {
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                }
                if($value->id_team_visitor!=$idMadrid){
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                }

            }
            $infoContrincantes=array();
            foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                $infoContrincantes[] = DB::table('teams')
                    ->select('name', 'image')->where('id', '=' , "$value")
                    ->get();
            }

            return view('matchesList')->with('ligas',$ligas)->with('idMadrid',$idMadrid)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado);
        }
        if($equipoSeleccionado=="barcelona"){
            $ligaSeleccionada=$request->input('selectCompeticiones');
            //$ligas=League::all();
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();

            //$idBarcelona=DB::select("select id from teams where name='F.C Barcelona'");
            $idBarcelonaArray=DB::table('teams')->select('id')->where('name','=','F.C Barcelona')->get();
            $idBarcelona=$idBarcelonaArray[0]->id;

            //PARTIDOS DEL BARCELONA DE LOCAL

            $partidosLigaLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "F.C Barcelona")->where('matches.id_league', '=' , "$ligaSeleccionada")
                ->get();

            //PARTIDOS DEL BARCELONA DE VISITANTE

            $partidosLigaVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=' , "F.C Barcelona")->where('matches.id_league', '=' , "$ligaSeleccionada")
                ->get();


            $arrayPartidos=array();

            //AÑADIENDO LOS PARTIDOS DE LOCAL Y VISITANTE A UN MISMO ARRAY

            foreach($partidosLigaLocal as $key => $value) {
                $arrayPartidos[] = $value;
            }
            foreach($partidosLigaVisitante as $key => $value) {
                $arrayPartidos[] = $value;
            }

            //ORDENANDO ESTE ULTIMO ARRAY POR EL CAMPO 'JOURNEY' DE MENOR A MAYOR PARA ASI ESTAR LOS PARTIDOS ORDENADOS POR JORNADA INDEPENDIENTEMENTE
            //DE SI EL MADRID JUGO DE LOCAL O VISITANTE


            foreach($arrayPartidos as $key =>$value){
                $aux=0;
                if($key==0){
                    $journeyMenor=$value->journey;
                }else{
                    for($i=$key;$i>0;$i--){
                        if($value->journey<$arrayPartidos[$i-1]->journey){
                            $aux=$arrayPartidos[$i-1];
                            $arrayPartidos[$i-1]=$value;
                            $arrayPartidos[$i]=$aux;
                        }
                    }
                }
            }

            //BUSQUEDA DE LOS ID DE LOS CLUBES CONTRICANTES AL MADRID EN TODOS LOS PARTIDOS

            $arrayNombresEImagenesOtrosEquipos=array();

            foreach ($arrayPartidos as $key => $value){
                if($value->id_team_local!=$idBarcelona) {
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_local;
                }
                if($value->id_team_visitor!=$idBarcelona){
                    $arrayNombresEImagenesOtrosEquipos[]=$value->id_team_visitor;
                }

            }
            $infoContrincantes=array();
            foreach ($arrayNombresEImagenesOtrosEquipos as $value){
                $infoContrincantes[] = DB::table('teams')
                    ->select('name', 'image')->where('id', '=' , "$value")
                    ->get();
            }

            return view('matchesList')->with('ligas',$ligas)->with('idBarcelona',$idBarcelona)->with('arrayPartidos',$arrayPartidos)->with('arrayNombresEImagenesOtrosEquipos',$arrayNombresEImagenesOtrosEquipos)->with('infoContrincantes',$infoContrincantes)->with('ligaSeleccionada',$ligaSeleccionada)->with('equipoSeleccionado',$equipoSeleccionado);
        }

    }*/

    /*public function devolverAddMatch(Request $request)
    {
        $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
        $idMadrid=$idMadridArray[0]->id;
        $idBarcelonaArray=DB::table('teams')->select('id')->where('name','=','F.C Barcelona')->get();
        $idBarcelona=$idBarcelonaArray[0]->id;
        if($request->route('equipo')=="madrid"){

            if($request->route('fallo')=="true"){
                $fallo=true;
                //$matches=Team::where('name','=','Real Madrid C.F')->where('name','=','F.C Barcelona')->get();
                //$clubes=DB::select("select * from teams where name='Real Madrid C.F' OR name='F.C Barcelona'");

                //CALCULAMOS LAS LIGAS EN LAS QUE TIENE PARTICIPACION ESTE EQUIPO

                $ligas = DB::table('leagues')
                    ->join('participates', 'leagues.id', '=', 'participates.id_league')
                    ->select('leagues.*')->where('participates.id_team', '=', "$idMadrid")
                    ->get();
                //$ligas=League::all();
                $equipos=Team::all();

                return view('addMatchMadrid')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
            }else{
                $fallo=false;
                //$matches=Team::where('name','=','Real Madrid C.F')->where('name','=','F.C Barcelona')->get();
                //$clubes=DB::select("select * from teams where name='Real Madrid C.F' OR name='F.C Barcelona'");
                //$libros = DB::table('books')->where('author', 'like', '%julio%')->get();
                //$teams = DB::table('teams')->where('name', '=', 'Real Madrid C.F')->where('name', '=', 'F.C Barcelona')->get();
                //$ligas=League::all();

                //CALCULAMOS LAS LIGAS EN LAS QUE TIENE PARTICIPACION ESTE EQUIPO

                $ligas = DB::table('leagues')
                    ->join('participates', 'leagues.id', '=', 'participates.id_league')
                    ->select('leagues.*')->where('participates.id_team', '=', "$idMadrid")
                    ->get();
                $equipos=Team::all();

                return view('addMatchMadrid')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
            }
        }else{
            if($request->route('fallo')=="true"){
                $fallo=true;
                //$matches=Team::where('name','=','Real Madrid C.F')->where('name','=','F.C Barcelona')->get();
                //$clubes=DB::select("select * from teams where name='Real Madrid C.F' OR name='F.C Barcelona'");
                //$libros = DB::table('books')->where('author', 'like', '%julio%')->get();
                //$ligas=League::all();

                //CALCULAMOS LAS LIGAS EN LAS QUE TIENE PARTICIPACION ESTE EQUIPO

                $ligas = DB::table('leagues')
                    ->join('participates', 'leagues.id', '=', 'participates.id_league')
                    ->select('leagues.*')->where('participates.id_team', '=', "$idBarcelona")
                    ->get();
                $equipos=Team::all();

                return view('addMatchBarcelona')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
            }else{
                $fallo=false;
                //$matches=Team::where('name','=','Real Madrid C.F')->where('name','=','F.C Barcelona')->get();
                //$clubes=DB::select("select * from teams where name='Real Madrid C.F' OR name='F.C Barcelona'");
                //$libros = DB::table('books')->where('author', 'like', '%julio%')->get();
                //$teams = DB::table('teams')->where('name', '=', 'Real Madrid C.F')->where('name', '=', 'F.C Barcelona')->get();
                //$ligas=League::all();

                //CALCULAMOS LAS LIGAS EN LAS QUE TIENE PARTICIPACION ESTE EQUIPO

                $ligas = DB::table('leagues')
                    ->join('participates', 'leagues.id', '=', 'participates.id_league')
                    ->select('leagues.*')->where('participates.id_team', '=', "$idBarcelona")
                    ->get();
                $equipos=Team::all();

                return view('addMatchBarcelona')->with('ligas',$ligas)->with("fallo",$fallo)->with('equipos',$equipos);
            }
        }

    }*/


    /*public function recibirAddMatch(Request $request)
    {

        if($request->route('equipo')=="madrid") {

            $partido = new Match();
            $partido->id_team_local = $request->input('localTeamAddMatch');
            $partido->id_team_visitor = $request->input('visitorTeamAddMatch');
            $partido->id_league = $request->input('league');
            $partido->journey = $request->input('journey');
            $partido->score_local = $request->input('scoreLocal');
            $partido->score_visitor = $request->input('scoreVisitor');

            //COMPROBANDO SI EXISTE ESA JORNADA DE ESE EQUIPO EN ESA LIGA

                //COMPROBANDO SI EXISTE ESE PARTIDO YA EN FORMA DE LOCAL

                $partidosLigaLocal = DB::table('matches')
                    ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=', "Real Madrid C.F")->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                    ->first();

                //COMPROBANDO SI EXISTE ESE PARTIDO YA EN FORMA DE VISITANTE

                $partidosLigaVisitante = DB::table('matches')
                    ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                    ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=', "Real Madrid C.F")->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                    ->first();

            //return $partidosLigaVisitante;

            //SI EL PARTIDO EXISTE REDIRIJE A LA VISTA CON EL ERROR PARA QUE USUARIO VEA QUE EL PARTIDO YA EXISTE, EN CASO CONTRARIO EL PARTIDO
            //SE GUARDARÁ

            if(isset($partidosLigaVisitante) || isset($partidosLigaLocal)){
                return redirect('/addMatch/true/madrid');
                //return "partido no disponible";
            }else{

                ///////////////////////////////REAJUSTE ESTADISTICAS MADRID///////////////////////////////////

                //OBTENCION IDS DE BARCELONA Y MADRID
                $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
                $idMadrid=$idMadridArray[0]->id;
                $idBarcelonaArray=DB::table('teams')->select('id')->where('name','=','F.C Barcelona')->get();
                $idBarcelona=$idBarcelonaArray[0]->id;

                //CALCULO DE ESTADISTICAS
                $ligaEnCuestionAddMatch=$request->input('league');
                $equipoLocalAddMatch=$request->input('localTeamAddMatch');
                $equipoVisitanteAddMatch=$request->input('visitorTeamAddMatch');
                $marcadorLocalAddMatch=$request->input('scoreLocal');
                $marcadorVisitanteAddMatch=$request->input('scoreVisitor');
                $madridLocal=false;
                $madridVisitante=false;
                $barcelonaLocal=false;
                $barcelonaVisitante=false;

                //COMPROBACION DE SI EL EQUIPO LOCAL ES MADRID

                if($equipoLocalAddMatch==$idMadrid){
                    $madridLocal=true;
                    echo "madrid local";
                }

                //COMPROBACION DE SI EL EQUIPO VISITANTE ES MADRID

                if($equipoVisitanteAddMatch==$idMadrid){
                    $madridVisitante=true;
                    echo "madrid visitante";
                }

                //COMPROBACION DE SI EL EQUIPO LOCAL ES BARCELONA

                if($equipoLocalAddMatch==$idBarcelona){
                    $barcelonaLocal=true;
                    echo "barcelona local";
                }

                //COMPROBACION DE SI EL EQUIPO VISITANTE ES BARCELONA

                if($equipoVisitanteAddMatch==$idBarcelona){
                    $barcelonaVisitante=true;
                    echo "barcelona visitante";
                }

                //AJUSTE ESTADISTICAS MADRID

                //SI EL MADRID ES LOCAL
                if($madridLocal==true){
                    $participacionAEditarBusqueda = DB::table('participates')
                        ->where('id_team', '=', "$idMadrid")->where('id_league','=',"$ligaEnCuestionAddMatch")->first();
                    $participacionAEditar = Participate::findOrFail($participacionAEditarBusqueda->id);

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditar->pj=$participacionAEditar->pj+1;
                    //CALCULO PARTIDOS GANADOS
                    if($marcadorLocalAddMatch > $marcadorVisitanteAddMatch){
                        $participacionAEditar->v=$participacionAEditar->v+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+3;
                    }
                    //CALCULO PARTIDOS EMPATADOS
                    if($marcadorLocalAddMatch == $marcadorVisitanteAddMatch){
                        $participacionAEditar->e=$participacionAEditar->e+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+1;
                    }
                    //CALCULO PARTIDOS PERDIDOS
                    if($marcadorLocalAddMatch < $marcadorVisitanteAddMatch){
                        $participacionAEditar->d=$participacionAEditar->d+1;
                        //CALCULO DE PUNTOS
                        //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
                    }
                    //CALCULO DE GOLES
                    $participacionAEditar->gf=$participacionAEditar->gf+$marcadorLocalAddMatch;
                    $participacionAEditar->gc=$participacionAEditar->gc+$marcadorVisitanteAddMatch;
                    $calculoDiferenciaGoles=$participacionAEditar->gf-$participacionAEditar->gc;
                    $participacionAEditar->dg=$calculoDiferenciaGoles;
                    $participacionAEditar->save();
                    //return $participacionAEditar;
                }
                //SI EL MADRID ES VISITANTE
                if($madridVisitante==true){
                    $participacionAEditarBusqueda = DB::table('participates')
                        ->where('id_team', '=', "$idMadrid")->where('id_league','=',"$ligaEnCuestionAddMatch")->first();
                    $participacionAEditar = Participate::findOrFail($participacionAEditarBusqueda->id);

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditar->pj=$participacionAEditar->pj+1;
                    //CALCULO PARTIDOS PERDIDOS
                    if($marcadorLocalAddMatch > $marcadorVisitanteAddMatch){
                        $participacionAEditar->d=$participacionAEditar->d+1;
                        //CALCULO DE PUNTOS
                        //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
                    }
                    //CALCULO PARTIDOS EMPATADOS
                    if($marcadorLocalAddMatch == $marcadorVisitanteAddMatch){
                        $participacionAEditar->e=$participacionAEditar->e+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+1;
                    }
                    //CALCULO PARTIDOS GANADOS
                    if($marcadorLocalAddMatch < $marcadorVisitanteAddMatch){
                        $participacionAEditar->v=$participacionAEditar->v+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+3;
                    }
                    //CALCULO DE GOLES
                    $participacionAEditar->gf=$participacionAEditar->gf+$marcadorVisitanteAddMatch;
                    $participacionAEditar->gc=$participacionAEditar->gc+$marcadorLocalAddMatch;
                    $calculoDiferenciaGoles=$participacionAEditar->gf-$participacionAEditar->gc;
                    $participacionAEditar->dg=$calculoDiferenciaGoles;
                    $participacionAEditar->save();

                }

                $partido->save();
                return redirect('/matches');
                //return "partido disponible";
            }
        }else{

            $partido = new Match();
            $partido->id_team_local = $request->input('localTeamAddMatch');
            $partido->id_team_visitor = $request->input('visitorTeamAddMatch');
            $partido->id_league = $request->input('league');
            $partido->journey = $request->input('journey');
            $partido->score_local = $request->input('scoreLocal');
            $partido->score_visitor = $request->input('scoreVisitor');

            //COMPROBANDO SI EXISTE ESA JORNADA DE ESE EQUIPO EN ESA LIGA

            //COMPROBANDO SI EXISTE ESE PARTIDO YA EN FORMA DE LOCAL

            $partidosLigaLocal = DB::table('matches')
                ->join('teams', 'matches.id_team_local', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=', "F.C Barcelona")->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();

            //COMPROBANDO SI EXISTE ESE PARTIDO YA EN FORMA DE VISITANTE

            $partidosLigaVisitante = DB::table('matches')
                ->join('teams', 'matches.id_team_visitor', '=', 'teams.id')
                ->select('matches.*', 'teams.image', 'teams.name')->where('teams.name', '=', "F.C Barcelona")->where('matches.id_league', '=', $request->input('league'))->where('matches.journey','=',$request->input('journey'))
                ->first();

            //return $partidosLigaVisitante;

            //SI EL PARTIDO EXISTE REDIRIJE A LA VISTA CON EL ERROR PARA QUE USUARIO VEA QUE EL PARTIDO YA EXISTE, EN CASO CONTRARIO EL PARTIDO
            //SE GUARDARÁ

            if(isset($partidosLigaVisitante) || isset($partidosLigaLocal)){
                return redirect('/addMatch/true/barcelona');
                //return "partido no disponible";
            }else{

                //////////////////////////////REAJUSTE ESTADISTICAS BARCELONA/////////////////////////////////

                //OBTENCION IDS DE BARCELONA Y MADRID
                $idMadridArray=DB::table('teams')->select('id')->where('name','=','Real Madrid C.F')->get();
                $idMadrid=$idMadridArray[0]->id;
                $idBarcelonaArray=DB::table('teams')->select('id')->where('name','=','F.C Barcelona')->get();
                $idBarcelona=$idBarcelonaArray[0]->id;

                //CALCULO DE ESTADISTICAS
                $ligaEnCuestionAddMatch=$request->input('league');
                $equipoLocalAddMatch=$request->input('localTeamAddMatch');
                $equipoVisitanteAddMatch=$request->input('visitorTeamAddMatch');
                $marcadorLocalAddMatch=$request->input('scoreLocal');
                $marcadorVisitanteAddMatch=$request->input('scoreVisitor');
                $barcelonaLocal=false;
                $barcelonaVisitante=false;


                //COMPROBACION DE SI EL EQUIPO LOCAL ES BARCELONA

                if($equipoLocalAddMatch==$idBarcelona){
                    $barcelonaLocal=true;
                    echo "barcelona local";
                }

                //COMPROBACION DE SI EL EQUIPO VISITANTE ES BARCELONA

                if($equipoVisitanteAddMatch==$idBarcelona){
                    $barcelonaVisitante=true;
                    echo "barcelona visitante";
                }
                //SI EL BARCELONA ES LOCAL
                if($barcelonaLocal==true){
                    $participacionAEditarBusqueda = DB::table('participates')
                        ->where('id_team', '=', "$idBarcelona")->where('id_league','=',"$ligaEnCuestionAddMatch")->first();
                    $participacionAEditar = Participate::findOrFail($participacionAEditarBusqueda->id);

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditar->pj=$participacionAEditar->pj+1;
                    //CALCULO PARTIDOS GANADOS
                    if($marcadorLocalAddMatch > $marcadorVisitanteAddMatch){
                        $participacionAEditar->v=$participacionAEditar->v+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+3;
                    }
                    //CALCULO PARTIDOS EMPATADOS
                    if($marcadorLocalAddMatch == $marcadorVisitanteAddMatch){
                        $participacionAEditar->e=$participacionAEditar->e+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+1;
                    }
                    //CALCULO PARTIDOS PERDIDOS
                    if($marcadorLocalAddMatch < $marcadorVisitanteAddMatch){
                        $participacionAEditar->d=$participacionAEditar->d+1;
                        //CALCULO DE PUNTOS
                        //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
                    }
                    //CALCULO DE GOLES
                    $participacionAEditar->gf=$participacionAEditar->gf+$marcadorLocalAddMatch;
                    $participacionAEditar->gc=$participacionAEditar->gc+$marcadorVisitanteAddMatch;
                    $calculoDiferenciaGoles=$participacionAEditar->gf-$participacionAEditar->gc;
                    $participacionAEditar->dg=$calculoDiferenciaGoles;
                    $participacionAEditar->save();
                    //return $participacionAEditar;
                }
                //SI EL BARCELONA ES VISITANTE
                if($barcelonaVisitante==true){
                    $participacionAEditarBusqueda = DB::table('participates')
                        ->where('id_team', '=', "$idBarcelona")->where('id_league','=',"$ligaEnCuestionAddMatch")->first();
                    $participacionAEditar = Participate::findOrFail($participacionAEditarBusqueda->id);

                    //CALCULO PARTIDOS JUGADOS
                    $participacionAEditar->pj=$participacionAEditar->pj+1;
                    //CALCULO PARTIDOS PERDIDOS
                    if($marcadorLocalAddMatch > $marcadorVisitanteAddMatch){
                        $participacionAEditar->d=$participacionAEditar->d+1;
                        //CALCULO DE PUNTOS
                        //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
                    }
                    //CALCULO PARTIDOS EMPATADOS
                    if($marcadorLocalAddMatch == $marcadorVisitanteAddMatch){
                        $participacionAEditar->e=$participacionAEditar->e+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+1;
                    }
                    //CALCULO PARTIDOS GANADOS
                    if($marcadorLocalAddMatch < $marcadorVisitanteAddMatch){
                        $participacionAEditar->v=$participacionAEditar->v+1;
                        //CALCULO DE PUNTOS
                        $participacionAEditar->points=$participacionAEditar->points+3;
                    }
                    //CALCULO DE GOLES
                    $participacionAEditar->gf=$participacionAEditar->gf+$marcadorVisitanteAddMatch;
                    $participacionAEditar->gc=$participacionAEditar->gc+$marcadorLocalAddMatch;
                    $calculoDiferenciaGoles=$participacionAEditar->gf-$participacionAEditar->gc;
                    $participacionAEditar->dg=$calculoDiferenciaGoles;
                    $participacionAEditar->save();

                }

                $partido->save();
                return redirect('/matches');
                //return "partido disponible";
            }
        }



    }*/

    public function editarPartidoVista(Request $request){
        $idPartidoAEditar=$request->input('guardarIdPartidoEditar');
        $partidoAEditar = Match::findOrFail($idPartidoAEditar);
        $clubes=Team::all();
        //redirect('/editMatch')->with('partidoAEditar',$partidoAEditar)->with('clubes',$clubes);
        return view('editMatch')->with('partidoAEditar',$partidoAEditar)->with('clubes',$clubes);
    }
    public function editarPartido(Request $request)
    {

        $idEquipoLocal = $request->input('guardarLocalTeamEditMatch');
        $idEquipoVisitante = $request->input('guardarVisitorTeamEditMatch');

        //OBTENCION DEL PARTIDO A EDITAR

        $idPartidoAEditar = $request->input('guardarIdEditMatch');
        $partidoAEditar = Match::findOrFail($idPartidoAEditar);
        $idLigaPartido = $partidoAEditar->id_league;

        //NUEVOS SCORES DEL PARTIDO
        $scoreLocalForm = $request->input('scoreLocalEditMatch');
        $scoreVisitorForm = $request->input('scoreVisitorEditMatch');

        //CALCULO DE ESTADISTICAS

        $localGanoAnteriormente = false;
        $visitanteGanoAnteriormente = false;
        $empatoAnteriormente = false;
        $participacionYaEditadaLocal = false;
        $participacionYaEditadaVisitante = false;
        //COMPROBACION DE SI EL LOCAL GANO

        if ($partidoAEditar->score_local > $partidoAEditar->score_visitor) {
            $localGanoAnteriormente = true;
        }

        //COMPROBACION DE SI EL VISITANTE GANO

        if ($partidoAEditar->score_local < $partidoAEditar->score_visitor) {
            $visitanteGanoAnteriormente = true;
        }

        //COMPROBACION DE SI AMBOS EMPATARON

        if ($partidoAEditar->score_local == $partidoAEditar->score_visitor) {
            $empatoAnteriormente = true;
        }

        //BUSCAMOS LA PARTICIPACION DE AMBOS EQUIPOS EN ESA LIGA, Y SI NO EXISTEN EN ESA LIGA, LAS CREAMOS

        $participacionLocal = DB::table('participates')
            ->where('id_team', '=', "$idEquipoLocal")->where('id_league', '=', "$idLigaPartido")->first();

        $participacionVisitante = DB::table('participates')
            ->where('id_team', '=', "$idEquipoVisitante")->where('id_league', '=', "$idLigaPartido")->first();

        if (isset($participacionLocal)) {
            $participacionAEditarLocal = Participate::findOrFail($participacionLocal->id);
            //return "la participacion del local existe";
        }
        if (!isset($participacionLocal)) {
            //return "la participacion del local no existe";
            $participacionNuevaLocal = new Participate();
            $participacionNuevaLocal->id_league = $idLigaPartido;
            $participacionNuevaLocal->id_team = $idEquipoLocal;
            $participacionNuevaLocal->pj = 1;
            if($scoreLocalForm > $scoreVisitorForm){
                $participacionNuevaLocal->v = 1;
                $participacionNuevaLocal->d = 0;
                $participacionNuevaLocal->e = 0;
                $participacionNuevaLocal->points = 3;
            }
            if($scoreLocalForm < $scoreVisitorForm){
                $participacionNuevaLocal->v = 0;
                $participacionNuevaLocal->d = 1;
                $participacionNuevaLocal->e = 0;
                $participacionNuevaLocal->points = 0;
            }
            if($scoreLocalForm == $scoreVisitorForm){
                $participacionNuevaLocal->v = 0;
                $participacionNuevaLocal->d = 0;
                $participacionNuevaLocal->e = 1;
                $participacionNuevaLocal->points = 1;
            }
            $participacionNuevaLocal->gf = $scoreLocalForm;
            $participacionNuevaLocal->gc = $scoreVisitorForm;
            $participacionNuevaLocal->dg = $scoreLocalForm - $scoreVisitorForm;
            $participacionNuevaLocal->save();
            $participacionYaEditadaLocal = true;
        }
        if (isset($participacionVisitante)) {
            $participacionAEditarVisitante = Participate::findOrFail($participacionVisitante->id);
            //return "la participacion del visitante existe";
        }
        if (!isset($participacionVisitante)) {
            //return "la participacion del visitante no existe";
            $participacionNuevaVisitante = new Participate();
            $participacionNuevaVisitante->id_league = $idLigaPartido;
            $participacionNuevaVisitante->id_team = $idEquipoVisitante;
            $participacionNuevaVisitante->pj = 1;
            if($scoreLocalForm > $scoreVisitorForm){
                $participacionNuevaVisitante->v = 0;
                $participacionNuevaVisitante->d = 1;
                $participacionNuevaVisitante->e = 0;
                $participacionNuevaVisitante->points = 0;
            }
            if($scoreLocalForm < $scoreVisitorForm){
                $participacionNuevaVisitante->v = 1;
                $participacionNuevaVisitante->d = 0;
                $participacionNuevaVisitante->e = 0;
                $participacionNuevaVisitante->points = 3;
            }
            if($scoreLocalForm == $scoreVisitorForm){
                $participacionNuevaVisitante->v = 0;
                $participacionNuevaVisitante->d = 0;
                $participacionNuevaVisitante->e = 1;
                $participacionNuevaVisitante->points = 1;
            }
            $participacionNuevaVisitante->gf = $scoreVisitorForm;
            $participacionNuevaVisitante->gc = $scoreLocalForm;
            $participacionNuevaVisitante->dg = $scoreVisitorForm - $scoreLocalForm;
            $participacionNuevaVisitante->save();
            $participacionYaEditadaVisitante = true;
        }

        //AJUSTE ESTADISTICAS LOCAL SI NO HAN SIDO AUN ACTUALIZADAS

        if ($participacionYaEditadaLocal == false) {

            //CALCULO PARTIDOS JUGADOS
            //(EL NUMERO DE PARTIDOS NO SE ALTERA)

            //CALCULAMOS SI EL CAMBIO DE RESULTADO HARIA QUE EL EQUIPO LOCAL AHORA; O GANARA, O PERDIERA, O EMPATARA

            //EL NUEVO RESULTADO HACE QUE EL LOCAL GANE, Y EL RESULTADO ORIGINAL FUE EMPATE
            if ($scoreLocalForm > $scoreVisitorForm && $empatoAnteriormente==true) {
                $participacionAEditarLocal->v = $participacionAEditarLocal->v + 1;
                $participacionAEditarLocal->e = $participacionAEditarLocal->e - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points + 2;
            }
            //EL NUEVO RESULTADO HACE QUE EL LOCAL GANE, Y EL RESULTADO ORIGINAL FUE DERROTA
            if ($scoreLocalForm > $scoreVisitorForm && $visitanteGanoAnteriormente==true) {
                $participacionAEditarLocal->v = $participacionAEditarLocal->v + 1;
                $participacionAEditarLocal->d = $participacionAEditarLocal->d - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points + 3;
            }
            //EL NUEVO RESULTADO HACE QUE EL LOCAL EMPATE, Y EL RESULTADO ORIGINAL FUE VICTORIA
            if ($scoreLocalForm == $scoreVisitorForm && $localGanoAnteriormente==true) {
                $participacionAEditarLocal->v = $participacionAEditarLocal->v - 1;
                $participacionAEditarLocal->e = $participacionAEditarLocal->e + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points - 2;
            }
            //EL NUEVO RESULTADO HACE QUE EL LOCAL EMPATE, Y EL RESULTADO ORIGINAL FUE DERROTA
            if ($scoreLocalForm == $scoreVisitorForm && $visitanteGanoAnteriormente==true) {
                $participacionAEditarLocal->d = $participacionAEditarLocal->d - 1;
                $participacionAEditarLocal->e = $participacionAEditarLocal->e + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points + 1;
            }
            //EL NUEVO RESULTADO HACE QUE EL LOCAL PIERDA, Y EL RESULTADO ORIGINAL FUE VICTORIA
            if ($scoreLocalForm < $scoreVisitorForm && $localGanoAnteriormente==true) {
                $participacionAEditarLocal->v = $participacionAEditarLocal->v - 1;
                $participacionAEditarLocal->d = $participacionAEditarLocal->d + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points - 3;
            }
            //EL NUEVO RESULTADO HACE QUE EL LOCAL PIERDA, Y EL RESULTADO ORIGINAL FUE EMPATE
            if ($scoreLocalForm < $scoreVisitorForm && $empatoAnteriormente==true) {
                $participacionAEditarLocal->d = $participacionAEditarLocal->d + 1;
                $participacionAEditarLocal->e = $participacionAEditarLocal->e - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points = $participacionAEditarLocal->points - 1;
            }

            //CALCULO DE GOLES

            //GOLES A FAVOR
            if ($scoreLocalForm > $partidoAEditar->score_local) {
                $diferenciaGoles = $scoreLocalForm - $partidoAEditar->score_local;
                $participacionAEditarLocal->gf = $participacionAEditarLocal->gf + $diferenciaGoles;
            }
            if ($scoreLocalForm < $partidoAEditar->score_local) {
                $diferenciaGoles = $partidoAEditar->score_local - $scoreLocalForm;
                $participacionAEditarLocal->gf = $participacionAEditarLocal->gf - $diferenciaGoles;
            }
            //GOLES EN CONTRA
            if ($scoreVisitorForm > $partidoAEditar->score_visitor) {
                $diferenciaGoles = $scoreVisitorForm - $partidoAEditar->score_visitor;
                $participacionAEditarLocal->gc = $participacionAEditarLocal->gc + $diferenciaGoles;
            }
            if ($scoreVisitorForm < $partidoAEditar->score_visitor) {
                $diferenciaGoles = $partidoAEditar->score_visitor - $scoreVisitorForm;
                $participacionAEditarLocal->gc = $participacionAEditarLocal->gc - $diferenciaGoles;
            }
            //DIFERENCIA DE GOLES
            $calculoDiferenciaGoles = $participacionAEditarLocal->gf - $participacionAEditarLocal->gc;
            $participacionAEditarLocal->dg = $calculoDiferenciaGoles;

            //EDICION
            $participacionAEditarLocal->save();
            //return $participacionAEditar;
        }
        //AJUSTE ESTADISTICAS VISITANTE SI NO HAN SIDO AUN ACTUALIZADAS

        if ($participacionYaEditadaVisitante == false) {

            //CALCULO PARTIDOS JUGADOS
            //(EL NUMERO DE PARTIDOS NO SE ALTERA)


            //CALCULAMOS SI EL CAMBIO DE RESULTADO HARIA QUE EL EQUIPO VISITANTE AHORA; O GANARA, O PERDIERA, O EMPATARA

            //EL NUEVO RESULTADO HACE QUE EL VISITANTE GANE, Y EL RESULTADO ORIGINAL FUE EMPATE
            if ($scoreLocalForm < $scoreVisitorForm && $empatoAnteriormente==true) {
                $participacionAEditarVisitante->v = $participacionAEditarVisitante->v + 1;
                $participacionAEditarVisitante->e = $participacionAEditarVisitante->e - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points + 2;
            }
            //EL NUEVO RESULTADO HACE QUE EL VISITANTE GANE, Y EL RESULTADO ORIGINAL FUE DERROTA
            if ($scoreLocalForm < $scoreVisitorForm && $localGanoAnteriormente==true) {
                $participacionAEditarVisitante->v = $participacionAEditarVisitante->v + 1;
                $participacionAEditarVisitante->d = $participacionAEditarVisitante->d - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points + 3;
            }
            //EL NUEVO RESULTADO HACE QUE EL VISITANTE EMPATE, Y EL RESULTADO ORIGINAL FUE VICTORIA
            if ($scoreLocalForm == $scoreVisitorForm && $visitanteGanoAnteriormente==true) {
                $participacionAEditarVisitante->v = $participacionAEditarVisitante->v - 1;
                $participacionAEditarVisitante->e = $participacionAEditarVisitante->e + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points - 2;
            }
            //EL NUEVO RESULTADO HACE QUE EL VISITANTE EMPATE, Y EL RESULTADO ORIGINAL FUE DERROTA
            if ($scoreLocalForm == $scoreVisitorForm && $localGanoAnteriormente==true) {
                $participacionAEditarVisitante->d = $participacionAEditarVisitante->d - 1;
                $participacionAEditarVisitante->e = $participacionAEditarVisitante->e + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points + 1;
            }
            //EL NUEVO RESULTADO HACE QUE EL VISITANTE PIERDA, Y EL RESULTADO ORIGINAL FUE VICTORIA
            if ($scoreLocalForm > $scoreVisitorForm && $visitanteGanoAnteriormente==true) {
                $participacionAEditarVisitante->v = $participacionAEditarVisitante->v - 1;
                $participacionAEditarVisitante->d = $participacionAEditarVisitante->d + 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points - 3;
            }
            //EL NUEVO RESULTADO HACE QUE EL VISITANTE PIERDA, Y EL RESULTADO ORIGINAL FUE EMPATE
            if ($scoreLocalForm > $scoreVisitorForm && $empatoAnteriormente==true) {
                $participacionAEditarVisitante->d = $participacionAEditarVisitante->d + 1;
                $participacionAEditarVisitante->e = $participacionAEditarVisitante->e - 1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points = $participacionAEditarVisitante->points - 1;
            }

            //CALCULO DE GOLES

            //GOLES A FAVOR
            if ($scoreVisitorForm > $partidoAEditar->score_visitor) {
                $diferenciaGoles = $scoreVisitorForm - $partidoAEditar->score_visitor;
                $participacionAEditarVisitante->gf = $participacionAEditarVisitante->gf + $diferenciaGoles;
            }
            if ($scoreVisitorForm < $partidoAEditar->score_visitor) {
                $diferenciaGoles = $partidoAEditar->score_visitor - $scoreVisitorForm;
                $participacionAEditarVisitante->gf = $participacionAEditarVisitante->gf - $diferenciaGoles;
            }
            //GOLES EN CONTRA
            if ($scoreLocalForm > $partidoAEditar->score_local) {
                $diferenciaGoles = $scoreLocalForm - $partidoAEditar->score_local;
                $participacionAEditarVisitante->gc = $participacionAEditarVisitante->gc + $diferenciaGoles;
            }
            if ($scoreLocalForm < $partidoAEditar->score_local) {
                $diferenciaGoles = $partidoAEditar->score_local - $scoreLocalForm;
                $participacionAEditarVisitante->gc = $participacionAEditarVisitante->gc - $diferenciaGoles;
            }
            //DIFERENCIA DE GOLES
            $calculoDiferenciaGoles = $participacionAEditarVisitante->gf - $participacionAEditarVisitante->gc;
            $participacionAEditarVisitante->dg = $calculoDiferenciaGoles;

            //EDICION
            $participacionAEditarVisitante->save();

        }

        //EDICION DEL PARTIDO EN CUESTION
        $partidoAEditar->score_local=$scoreLocalForm;
        $partidoAEditar->score_visitor=$scoreVisitorForm;
        $partidoAEditar->save();
        return redirect('/matches');
    }
    public function eliminarPartido(Request $request){
        //OBTENCION DEL PARTIDO A ELIMINAR
        $idPartidoAEliminar=$request->route('id');
        $partidoAEliminar = Match::findOrFail($idPartidoAEliminar);
        $idEquipoLocalEliminarPartido= $partidoAEliminar->id_team_local;
        $idEquipoVisitanteEliminarPartido= $partidoAEliminar->id_team_visitor;
        $ligaEnCuestion=$partidoAEliminar->id_league;

        //CALCULO DE ESTADISTICAS

        //BUSCAMOS LA PARTICIPACION DE AMBOS EQUIPOS EN ESA LIGA

        $participacionLocal = DB::table('participates')
            ->where('id_team', '=', "$idEquipoLocalEliminarPartido")->where('id_league', '=', "$ligaEnCuestion")->first();

        $participacionVisitante = DB::table('participates')
            ->where('id_team', '=', "$idEquipoVisitanteEliminarPartido")->where('id_league', '=', "$ligaEnCuestion")->first();

        $participacionAEditarLocal = Participate::findOrFail($participacionLocal->id);
        $participacionAEditarVisitante = Participate::findOrFail($participacionVisitante->id);



        //AJUSTE ESTADISTICAS LOCAL

            //CALCULO PARTIDOS JUGADOS
            $participacionAEditarLocal->pj=$participacionAEditarLocal->pj-1;
            //CALCULO PARTIDO GANADO
            if($partidoAEliminar->score_local > $partidoAEliminar->score_visitor){
                $participacionAEditarLocal->v=$participacionAEditarLocal->v-1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points=$participacionAEditarLocal->points-3;
            }
            //CALCULO PARTIDO EMPATADO
            if($partidoAEliminar->score_local == $partidoAEliminar->score_visitor){
                $participacionAEditarLocal->e=$participacionAEditarLocal->e-1;
                //CALCULO DE PUNTOS
                $participacionAEditarLocal->points=$participacionAEditarLocal->points-1;
            }
            //CALCULO PARTIDO PERDIDO
            if($partidoAEliminar->score_local < $partidoAEliminar->score_visitor){
                $participacionAEditarLocal->d=$participacionAEditarLocal->d-1;
                //CALCULO DE PUNTOS
                //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
            }
            //CALCULO DE GOLES
            $participacionAEditarLocal->gf=$participacionAEditarLocal->gf-$partidoAEliminar->score_local;
            $participacionAEditarLocal->gc=$participacionAEditarLocal->gc-$partidoAEliminar->score_visitor;
            $calculoDiferenciaGoles=$participacionAEditarLocal->gf-$participacionAEditarLocal->gc;
            $participacionAEditarLocal->dg=$calculoDiferenciaGoles;
            $participacionAEditarLocal->save();
            //return $participacionAEditar;

        //AJUSTE ESTADISTICAS VISITANTE

            //CALCULO PARTIDOS JUGADOS
            $participacionAEditarVisitante->pj=$participacionAEditarVisitante->pj-1;
            //CALCULO PARTIDO GANADO
            if($partidoAEliminar->score_local < $partidoAEliminar->score_visitor){
                $participacionAEditarVisitante->v=$participacionAEditarVisitante->v-1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points=$participacionAEditarVisitante->points-3;
            }
            //CALCULO PARTIDO EMPATADO
            if($partidoAEliminar->score_local == $partidoAEliminar->score_visitor){
                $participacionAEditarVisitante->e=$participacionAEditarVisitante->e-1;
                //CALCULO DE PUNTOS
                $participacionAEditarVisitante->points=$participacionAEditarVisitante->points-1;
            }
            //CALCULO PARTIDO PERDIDO
            if($partidoAEliminar->score_local > $partidoAEliminar->score_visitor){
                $participacionAEditarVisitante->d=$participacionAEditarVisitante->d-1;
                //CALCULO DE PUNTOS
                //(AQUI NO PIERDE PUNTOS, SIMPLEMENTE PIERDE EL PARTIDO JUGADO AL ELIMINAR
            }
            //CALCULO DE GOLES
            $participacionAEditarVisitante->gf=$participacionAEditarVisitante->gf-$partidoAEliminar->score_visitor;
            $participacionAEditarVisitante->gc=$participacionAEditarVisitante->gc-$partidoAEliminar->score_local;
            $calculoDiferenciaGoles=$participacionAEditarVisitante->gf-$participacionAEditarVisitante->gc;
            $participacionAEditarVisitante->dg=$calculoDiferenciaGoles;
            $participacionAEditarVisitante->save();
            //return $participacionAEditar;

        //ELIMINACION DEL PARTIDO
        $partidoAEliminar->delete();
        return redirect('/matches');
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
