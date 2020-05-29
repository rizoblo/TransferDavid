<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class leagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function devolverLeague(Request $request)
    {
        $idLiga=$request->route('id');
        $contador=0;
        $idTemporada=0;
        $partidosLiga = DB::table('participates')
            ->join('teams', 'participates.id_team', '=', 'teams.id')
            ->select('participates.*', 'teams.image', 'teams.name')->where('participates.id_league', '=' , "$idLiga")->orderBy('points', 'desc')
            ->get();

        if($idLiga<3){
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();
            return view('ligaSantander')->with('partidosLiga',$partidosLiga)->with('contador',$contador)->with('ligas',$ligas)->with('ligaSeleccionada',$idTemporada);

        }
        if($idLiga==3){
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Premier%')->get();
            return view('premierLeague')->with('partidosLiga',$partidosLiga)->with('contador',$contador)->with('ligas',$ligas)->with('ligaSeleccionada',$idTemporada);

        }
    }
    public function devolverLeagueForm(Request $request)
    {
        $idTemporada=$request->input('selectCompeticiones');
        $contador=0;
        $partidosLiga = DB::table('participates')
            ->join('teams', 'participates.id_team', '=', 'teams.id')
            ->select('participates.*', 'teams.image', 'teams.name')->where('participates.id_league', '=' , "$idTemporada")->orderBy('points', 'desc')
            ->get();
        if($idTemporada<3){
            $ligas = DB::table('leagues')
                ->where('name', 'like', '%Espa%')->get();
            return view('ligaSantander')->with('partidosLiga',$partidosLiga)->with('contador',$contador)->with('ligas',$ligas)->with('ligaSeleccionada',$idTemporada);

        }
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
