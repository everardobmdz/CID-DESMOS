@extends('layouts.plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
            <h2 class="mb-4">Divulgación</h2>
        </div>
    </div>
    @foreach($divulgaciones->chunk(4) as $chunk)
        <div class="row post-columns">
            @foreach($chunk as $divulgacion)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="post mb-20">
                    <div class="video-responsive">
                        <iframe
                        
                            src="{{'https://www.youtube.com/embed/'.explode('=',$divulgacion->link)[1]}}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <div class="post-header font-alt">
                        <h2 class="post-title"><a href="{{route('divulgaciones.show',$divulgacion->id)}}">{{$divulgacion->titulo}}</a></h2>

                    </div>
                    <div class="post-entry">
                        <p>{!!strip_tags($divulgacion->descripcion)!!}</p>
                    </div>
                    <div class="post-more"><a class="more-link" href="{{route('divulgaciones.show',$divulgacion->id)}}">Leer más</a></div>

                </div>
            </div>
        
            @endforeach
        </div>
    @endforeach
    <div class="d-flex">
        {!! $divulgaciones->links() !!}
    </div>
</div>

@endsection

