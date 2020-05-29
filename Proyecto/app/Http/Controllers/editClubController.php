<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class editClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $club = Team::findOrFail($request->route('id'));
        return view('editClub')->with('club',$club);
    }
    public function recibirFormulario(Request $request){

        $club = Team::findOrFail($request->route('id'));
        $originalImage=$club->image;
        $originalWallpaper=$club->wallpaper;

        if($request->input('name')!=""){
            $club->name=$request->input('name');
        }

        $club->fundation=$request->input('fundation');
        $club->stadium=$request->input('stadium');
        $club->coach=$request->input('coach');
        $club->nationality=$request->input('nationality');
        $club->review=$request->input('review');
        $club->web=$request->input('web');
        $file1=$request->file('image');
        $file2=$request->file('wallpaper');
        if(isset($file1)){
            $nombreArchivo=$_FILES['image']['name'];
            $tipoArchivo=$_FILES['image']['type'];
            $tamanioArchivo=$_FILES['image']['size'];
            //$club->image= "/TransferDavid/storage/app/".$request->file('image')->store('images');
            $club->image="storage/".Storage::disk('images')->put('images', $request->file('image'));

        }
        if(isset($file2)){
            $nombreArchivo=$_FILES['wallpaper']['name'];
            $tipoArchivo=$_FILES['wallpaper']['type'];
            $tamanioArchivo=$_FILES['wallpaper']['size'];
            //$club->wallpaper= "/TransferDavid/storage/app/".$request->file('wallpaper')->store('images');
            $club->wallpaper="storage/".Storage::disk('images')->put('images', $request->file('wallpaper'));

        }
        $club->save();
        return redirect('/clubes');
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
