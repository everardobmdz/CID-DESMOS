@extends('layouts.plantilla')

@section('content')
    <div class="container py-5 container-individual-pages">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{$divulgacion->titulo}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    {!!$divulgacion->descripcion!!}
                </div>
            </div>
        </div>
        <div class="video-divulgacion">
            <iframe 
                width="560" 
                height="315" 
                src="{{'https://www.youtube.com/embed/'.explode('=',$divulgacion->link)[1]}}"
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>

        </div>
        <div class="row">

            <div class="col-md-12">
                @if($archivos)
                    <h5><b>Archivos adjuntos</b></h5>
                @endif
                @foreach($archivos as $archivo)
                        <div class="file mb-1">
                            <a target="_blank" href="{{url('storage/files/'.$archivo->path)}}">{{$archivo->path}}</a>
                        </div>

                @endforeach
            </div>
        </div>

    </div>
@endsection
