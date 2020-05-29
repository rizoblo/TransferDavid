<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class addTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addTeam');
    }
    public function recibirFormulario(Request $request){
        $team=new Team();
        $team->name=$request->input('name');
        $team->fundation=$request->input('fundation');
        $team->stadium=$request->input('stadium');
        $team->coach=$request->input('coach');
        $team->nationality=$request->input('nationality');
        $team->review=$request->input('review');
        $team->web=$request->input('web');

        //GESTION DE LA IMAGEN DEL ESCUDO

        $file=$request->file('image');
        $nombreArchivo=$_FILES['image']['name'];
        $tipoArchivo=$_FILES['image']['type'];
        $tamanioArchivo=$_FILES['image']['size'];
        //$team->image= "/TransferDavid/storage/app/".$request->file('image')->store('images');
        $team->image="storage/".Storage::disk('images')->put('images', $request->file('image'));

        //GESTION DE LA IMAGEN DEL WALLPAPER

        $file2=$request->file('wallpaper');
        $nombreArchivo=$_FILES['wallpaper']['name'];
        $tipoArchivo=$_FILES['wallpaper']['type'];
        $tamanioArchivo=$_FILES['wallpaper']['size'];
        //$team->wallpaper= "/TransferDavid/storage/app/".$request->file('wallpaper')->store('images');
        $team->wallpaper="storage/".Storage::disk('images')->put('images', $request->file('wallpaper'));

        $team->save();
        return redirect('/administration');
        //return view('index')->with("arrayListoVela",$arrayListoVela)->with("arrayListoSigloXX",$arrayListoSigloXX)->with("arrayListoCiviles",$arrayListoCiviles);
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
