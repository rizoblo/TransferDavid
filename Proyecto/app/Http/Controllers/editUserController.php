<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class editUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$datosUsuario=User::where('email','=',Auth()->user()->email)->get();
        if($request->route('var1')=='noAdmin'){
            $variable="noAdmin";
            $user=User::FindOrFail(Auth()->user()->id);
            $teams=Team::all();
            return view('editUser')->with("user",$user)->with('teams',$teams)->with('variable',$variable);
        }else{
            $variable="admin";
            $user=User::FindOrFail($request->route('id'));
            $teams=Team::all();
            return view('editUser')->with("user",$user)->with('teams',$teams)->with('variable',$variable);
        }


    }
    public function eliminarCuenta(Request $request){
        if($request->route('var1')=='noAdmin') {
            $user = User::findOrFail($request->route('id'));
            $user->delete();
            Auth::logout();
            return redirect('/');
        }
        if($request->route('var1')!='noAdmin') {
            if(Auth()->user()->id==$request->route('id')){
                $user = User::findOrFail($request->route('id'));
                $user->delete();
                Auth::logout();
                return redirect('/');
            }else{
                $user = User::findOrFail($request->route('id'));
                $user->delete();
                return redirect('/administration');
            }

        }


    }
    public function validarForm(Request $request){
        //$user=User::FindOrFail(Auth()->user()->id);
        $user = User::findOrFail($request->route('id'));
        if($request->input('passActual')!=""){
            $validacion =request()->validate([
                'passActual'=>[
                    function($attribute,$value,$fail){
                        if(!(Hash::check($value,Auth()->user()->password))){
                            $fail('La contraseña del usuario no coincide, no puede cambiar la contraseña.');
                        }
                    }
                ],
                'Contraseña1'=>[
                    'required',
                    'same:Contraseña2',
                ],
            ]);
            $user->name=$request->input('name');
            $user->last_name=$request->input('last_name');
            $user->last_name2=$request->input('last_name2');
            $user->email=$request->input('email');
            $user->password=Hash::make($request->input('Contraseña1'));
            $user->fav_team=$request->input('fav_team');
            $user->role=$request->input('role');
            $user->user_description=$request->input('user_description');
            $user->save();
            return redirect('/administration');
        }else{
            $user->name=$request->input('name');
            $user->last_name=$request->input('last_name');
            $user->last_name2=$request->input('last_name2');
            $user->email=$request->input('email');
            $user->password=Auth()->user()->password;
            $user->fav_team=$request->input('fav_team');
            $user->role=$request->input('role');
            $user->user_description=$request->input('user_description');
            $user->save();
            return redirect('/administration');
        }
        /*if (Hash::check($request->input('passActual'), $passDelUserLogeado))
        {
            return "coincide";
        }else{
            return "no coincide";
        }*/

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
