<?php

namespace App\Http\Controllers;

use App\Notice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class noticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$noticias=Notice::all();
        $usuarios=User::all();
        $noticias=Notice::orderBy('id', 'DESC')->get();
        return view('index')->with('noticias',$noticias)->with('usuarios',$usuarios);
    }

    public function noticeInfo(Request $request)
    {
        $idNoticia=$request->route('id');
        $noticia=Notice::findOrFail($idNoticia);
        $usuarios=User::all();
        $otrasNoticias=Notice::all();
        $arrayIDSNoticias=array();
        $arrayIDSNoticias2=array();
        $contador=0;
        foreach ($otrasNoticias as $noticiaBucle){
            if($noticiaBucle->id != $noticia->id){
                $arrayIDSNoticias[]=$noticiaBucle;
            }
        }
        shuffle($arrayIDSNoticias);
        foreach ($arrayIDSNoticias as $noticiaBucle2){
            if($noticiaBucle2->id != $noticia->id && $contador<3){
                $arrayIDSNoticias2[]=$noticiaBucle2;
                $contador++;
            }
        }

        return view('noticeInfo')->with('noticia',$noticia)->with('usuarios',$usuarios)->with('arrayIDSNoticias',$arrayIDSNoticias2);

    }
    public function noticeInfoOther(Request $request)
    {
        $idNoticia=$request->route('id');
        $noticia=Notice::findOrFail($idNoticia);
        $usuarios=User::all();
        $otrasNoticias=Notice::all();
        $arrayIDSNoticias=array();
        $arrayIDSNoticias2=array();
        $contador=0;
        foreach ($otrasNoticias as $noticiaBucle){
            if($noticiaBucle->id != $noticia->id){
                $arrayIDSNoticias[]=$noticiaBucle;
            }
        }
        shuffle($arrayIDSNoticias);
        foreach ($arrayIDSNoticias as $noticiaBucle2){
            if($noticiaBucle2->id != $noticia->id && $contador<3){
                $arrayIDSNoticias2[]=$noticiaBucle2;
                $contador++;
            }
        }
        return view('noticeInfo')->with('noticia',$noticia)->with('usuarios',$usuarios)->with('arrayIDSNoticias',$arrayIDSNoticias2);

    }

    public function devolverFormAddNotice()
    {
        return view('addNotice');
    }

    public function recibirFormAddNotice(Request $request){
        $noticia=new Notice();

        $noticia->id_user=Auth()->user()->id;
        $noticia->title=$request->input('titleNoticeAdd');
        $noticia->subtitle=$request->input('subtitleNoticeAdd');
        $noticia->description=$request->input('descriptionNoticeAdd');

        //GESTION IMAGEN

        $file=$request->file('image');
        $nombreArchivo=$_FILES['image']['name'];
        $tipoArchivo=$_FILES['image']['type'];
        $tamanioArchivo=$_FILES['image']['size'];
        //$team->image= "/TransferDavid/storage/app/".$request->file('image')->store('images');
        $noticia->image="storage/".Storage::disk('images')->put('images', $request->file('image'));
        $noticia->save();
        return redirect('/');
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
