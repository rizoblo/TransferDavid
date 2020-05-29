@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/styles.css')}}">
    <div class="col-md-12 justify-content-center text-center">
        <div class="row">
            <div class="col-md-9">
                <h1 class="mt-3 fuenteTitulo backGroundCabeceras">Noticias</h1>
                <div class="row overflowPers">
                    @if(isset($noticias))
                        @foreach($noticias as $noticia)

                            <div class="col-lg-4 col-md-6 col-sm-12 justify-content-center animacionNoticias mb-1" >
                                <a href="{{url('/noticeView/'.$noticia->id)}}" style="text-decoration: none">
                                    <div class="card border-info mt-2 contNoticia" style="height: 530px !important">
                                        <div class="card-img-top" style="width: 100% !important;height: 250px !important;">
                                            <img alt="noticeImage" style="width: 100%;height: 100%" src="{{asset($noticia->image)}}" alt="Card image cap">
                                        </div>
                                        <div class="card-body text-info mt-2" >
                                            <h2 class="card-title aT" >{{$noticia->title}}</h2>
                                            <p class="card-text aT2">{{$noticia->subtitle}}</p>
                                            @foreach($usuarios as $usuario)
                                                @if($usuario->id == $noticia->id_user)
                                                    <h6 style="" class="card-title">Subida por: {{$usuario->name}}</h6>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-3 ocultamiento">
                <div class="col-md-12 border-3 tw-title mt-5 animacionTW">
                    <a class="twitter-timeline" data-lang="es" data-width="350" data-height="1050" data-theme="dark" href="https://twitter.com/UEFAcom_es?ref_src=twsrc%5Etfw">Tweets by UEFAcom_es</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>



    </div>
@endsection