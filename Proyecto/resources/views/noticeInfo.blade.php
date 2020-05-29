@extends('layouts.master')
@section('content')
    <div class="container justify-content-center text-center fuenteBlanca">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 mb-3" >
                        <h5 style="word-wrap: break-word;"><i>{{$noticia->subtitle}}</i></h5>
                        <h1 style="word-wrap: break-word;"><b>{{$noticia->title}}</b></h1>
                        <div class="img-fluid" style="width: 80% !important;height: 500px !important;margin-left:10%;">
                            <img style="width: 100%;height: 100%" class="img-fluid" src="{{asset($noticia->image)}}">
                        </div>
                            <hr class="estilosHrAdministration">
                            <span style="text-align: left;margin-right: 35%">Fecha: {{ $noticia->created_at}}</span>
                            <span style="text-align: right">
                                    @foreach($usuarios as $usuario)
                                    @if($usuario->id == $noticia->id_user)
                                        Subida por: {{$usuario->name}}
                                    @endif
                                @endforeach</span>
                            <hr class="estilosHrAdministration">
                        <textarea class="mt-5" style="border: none;background-color:#020f3c;color:white;word-wrap: break-word;text-align:left;" cols="90" rows="20">{{$noticia->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12"><h2>Otras Noticias:</h2></div>
            </div>
            <div class="row mt-5">
                @foreach($arrayIDSNoticias as $value)
                <div class="col-md-4 otherNotice">
                    <a style="text-decoration: none" href="{{url('/noticeViewOther/'.$value->id)}}">
                    <div class="img-fluid" style="width: 100% !important;height: 300px !important;">
                        <img style="width: 100%;height: 100%" src="{{asset($value->image)}}">
                    </div>
                    </a>
                    <h6 class="h6stylo" style="word-wrap: break-word;">{{$value->title}}</h6>

                </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection