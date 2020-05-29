<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class playerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODOS LOS JUGADORES
        //$jugadores=Player::all();
        $jugadores = DB::table('players')
            ->join('teams', 'players.id_team', '=', 'teams.id')
            ->select('players.*', 'teams.image')->orderBy('value', 'desc')->get();
        $teams=Team::all();
        //$jugadores=DB::select("select players.*, teams.image from players,teams where players.id_team=teams.id");
        return view('jugadores')->with('jugadores',$jugadores)->with('teams',$teams);
    }

    public function findPlayer(Request $request)
    {
        $nombreJugador=$request->input('nameFindPlayer');
        $equipoJugador=$request->input('teamFindPlayer');
        $posicionJugador=$request->input('positionFindPlayer');
        $saludo="gilipollas";
        //$jugadores=DB::select("select players.*, teams.image from players,teams where players.id_team=teams.id");

        //POR NOMBRE
            //POR NOMBRE RELLENADO SOLO
            if($nombreJugador!="" && $equipoJugador=="Todos" && $posicionJugador=="Todas"){
                $jugadores = Player::select('players.*', 'teams.image')
                    ->join('teams', 'players.id_team', '=', 'teams.id')->where('players.name','like', '%'. "$nombreJugador".'%')->orWhere('players.last_name', 'like', '%' . $nombreJugador . '%')->get();
            }
            //POR NOMBRE RELLENADO CON EQUIPO RELLENADO
            if($nombreJugador!="" && $equipoJugador!="Todos" && $posicionJugador=="Todas"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where (players.name like '%".$nombreJugador."%' or players.last_name like '%".$nombreJugador."%') && players.id_team=".$equipoJugador." && players.id_team=teams.id");
            }
            //POR NOMBRE RELLENADO CON POSICION RELLENADA
            if($nombreJugador!="" && $equipoJugador=="Todos" && $posicionJugador!="Todas"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where (players.name like '%".$nombreJugador."%' or players.last_name like '%".$nombreJugador."%') && players.position='".$posicionJugador."' && players.id_team=teams.id");
            }
        //POR EQUIPO
            //POR EQUIPO RELLENADO SOLO
            if($equipoJugador!="Todos" && $nombreJugador=="" && $posicionJugador=="Todas"){
                $jugadores = Player::select('players.*', 'teams.image')
                    ->join('teams', 'players.id_team', '=', 'teams.id')->where('players.id_team','=', "$equipoJugador")->get();
            }
            //POR EQUIPO RELLENADO CON NOMBRE RELLENADO
            if($equipoJugador!="Todos" && $nombreJugador!="" && $posicionJugador=="Todas"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where (players.name like '%".$nombreJugador."%' or players.last_name like '%".$nombreJugador."%') && players.id_team=".$equipoJugador." && players.id_team=teams.id");
            }
            //POR EQUIPO RELLENADO CON POSICION RELLENADA
            if($equipoJugador!="Todos" && $nombreJugador=="" && $posicionJugador!="Todas"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where players.id_team=".$equipoJugador." && players.position='".$posicionJugador."' && players.id_team=teams.id");
            }
        //POR POSICION
            //POR POSICION RELLENADA SOLO
            if($posicionJugador!="Todas" && $equipoJugador=="Todos" && $nombreJugador==""){
                $jugadores = Player::select('players.*', 'teams.image')
                    ->join('teams', 'players.id_team', '=', 'teams.id')->where('players.position','=', "$posicionJugador")->get();
            }
            //POR POSICION RELLENADO CON NOMBRE RELLENADO
            if($posicionJugador!="Todas" && $nombreJugador!="" && $equipoJugador=="Todos"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where (players.name like '%".$nombreJugador."%' or players.last_name like '%".$nombreJugador."%') && players.position='".$posicionJugador."' && players.id_team=teams.id");
            }
            //POR POSICION RELLENADO CON EQUIPO RELLENADA
            if($posicionJugador!="Todas" && $nombreJugador=="" && $equipoJugador!="Todos"){
                $jugadores=DB::select("select distinct players.*,teams.image from players,teams where players.id_team=".$equipoJugador." && players.position='".$posicionJugador."' && players.id_team=teams.id");
            }
        //POR NOMBRE RELLENADO, EQUIPO RELLENADO, POSICION RELLENADA
        if($nombreJugador!="" && $equipoJugador!="Todos" && $posicionJugador!="Todas"){
            $saludo="nombre";
            $jugadores=DB::select("select distinct players.*,teams.image from players,teams where (players.name like '%".$nombreJugador."%' or players.last_name like '%".$nombreJugador."%') && players.id_team=".$equipoJugador." && players.position='".$posicionJugador."' && players.id_team=teams.id");
        }
        //NINGUN FILTRO
        if($equipoJugador=="Todos" && $posicionJugador=="Todas" && $nombreJugador==""){
            $jugadores = Player::select('players.*', 'teams.image')
                ->join('teams', 'players.id_team', '=', 'teams.id')->get();
        }
        //$teams=Team::all();
        //return view('addPlayer')->with('teams',$teams);
        //var_dump($jugadoresBusquedaNombres);
        $teams=Team::all();
        $arrayIDS=array();
        foreach ($jugadores as $jugador){
             $arrayIDS[]=$jugador->id;
        }
        return view('jugadores')->with('jugadores',$jugadores)->with('teams',$teams)->with('arrayIDS',$arrayIDS);
    }
    /*public function orderPlayer(Request $request)
    {
        $arrayIDS=$request->input('guardarOrdersPlayers');
        $ordenacion=$request->input('selectOrderPlayers');
        $decodeArrayIDS=json_decode($arrayIDS);
        foreach ($decodeArrayIDS as $value){
            $arrayJugadores[]=DB::select("select distinct players.*,teams.image from players,teams where players.id=".$value." && players.id_team=teams.id");
        }
        //var_dump($arrayJugadores);
        //echo $arrayJugadores[2][0]->value;
        if($ordenacion==2){
            foreach ($arrayJugadores as $key => $jugador){
                $aux=0;
                foreach ($jugador as $key2 => $value){
                    echo $jugador[$key2]->value;
                    for($i=$key2;$i>0;$i--){
                        if($jugador[$key2]->value<$jugador[$i-1]->value){
                            $aux=$jugador[$i-1];
                            $jugador[$i-1]=$jugador[$key2];
                            $jugador[$i]=$aux;
                        }
                    }
                }

            }
        }
        if($ordenacion==1){
            foreach ($arrayJugadores as $key => $jugador){
                echo $jugador[0]->name;
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
        }

        //$longitud=sizeof($jugadores);
        //for($i=0;$i<$jugadores.size)
        $teams=Team::all();
        //return view('addPlayer')->with('teams',$teams);
        return $arrayJugadores;
        //return view('jugadores')->with('jugadores',$jugadores)->with('teams',$teams);
    }*/



    //ADICION DE JUGADORES

    public function addPlayerView()
    {
        $teams=Team::all();
        return view('addPlayer')->with('teams',$teams);
    }
    public function addPlayer(Request $request)
    {
        $teams=Team::all();
        $player=new Player();
        $player->id_team=$request->input('teamPlayer');
        $player->name=$request->input('namePlayer');
        $player->last_name=$request->input('lastnamePlayer');
        $player->position=$request->input('positionPlayer');
        $player->value=$request->input('valuePlayer');
        $player->player_image="storage/".Storage::disk('images')->put('images', $request->file('image'));
        $player->save();
        $jugadores = DB::table('players')
            ->join('teams', 'players.id_team', '=', 'teams.id')
            ->select('players.*', 'teams.image')->get();
        /*return view('jugadores')->with('teams',$teams)->with('jugadores',$jugadores);*/
        return redirect('/administration');
    }


    //EDICION DE JUGADORES

    public function editarJugadorVista(Request $request)
    {
        $id=$request->route('id');
        $jugadorAEditar=Player::findOrFail($id);
        $teams=Team::all();
        return view('editPlayer')->with('jugadorAEditar',$jugadorAEditar)->with('teams',$teams);
    }
    public function editarJugador(Request $request)
    {
        $id=$request->route('id');
        $jugadorAEditar=Player::findOrFail($id);
        $jugadorAEditar->name=$request->input('namePlayerEdit');
        $jugadorAEditar->id_team=$request->input('teamPlayerEdit');
        $jugadorAEditar->last_name=$request->input('lastnamePlayerEdit');
        $jugadorAEditar->position=$request->input('positionPlayerEdit');
        $jugadorAEditar->value=$request->input('valuePlayerEdit');
        $file1=$request->file('image');
        if(isset($file1)){
            $nombreArchivo=$_FILES['image']['name'];
            $tipoArchivo=$_FILES['image']['type'];
            $tamanioArchivo=$_FILES['image']['size'];
            //$club->image= "/TransferDavid/storage/app/".$request->file('image')->store('images');
            $jugadorAEditar->player_image="storage/".Storage::disk('images')->put('images', $request->file('image'));

        }
        $jugadorAEditar->save();
        return redirect('/jugadores');
        //return view('editPlayer');
    }

    //ELIMINACION DE JUGADORES

    public function eliminarJugador(Request $request)
    {
        $id=$request->route('id');
        $jugadorAEliminar=Player::findOrFail($id);
        $jugadorAEliminar->delete();
        return redirect('/jugadores');
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
