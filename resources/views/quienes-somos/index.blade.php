@extends('layouts.plantilla')
@section('content')
<section class="module" id="services">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <h2 class="module-title font-alt">Quiénes somos</h2>
            </div>
        </div>
        <div class="row multi-columns-row">
            <div class="col-md-12">
                <div class="features-item">
                @foreach($secciones as $seccion)
                    @if($seccion->icono)
                        <div class="features-icon text-center"><span class="{{$seccion->icono}}"></span></div>
                    @endif
                    <h3 class="features-title font-alt text-center">{!!$seccion->titulo!!}</h3>
                    <p>
                        {!!$seccion->contenido!!}
                    </p>
                @endforeach
                    <h3 class="features-title font-alt text-center">Extensión</h3>
                    <div class="somos-extension container">
                        <div class="row">
                            <div class="extension-element col-md-6 col-lg-3">
                                <a target="_blank" href="https://www.facebook.com/ObserVamos" class="extension-container bg-extension2" style="background-image: url('../public/images/observatorio.jpg');">

                                </a>
                            </div>
                            
                            <div class="extension-element col-md-6 col-lg-3">
                                <a target="_blank" href="http://www.cucsh.udg.mx/cmarti/historia" class="extension-container bg-extension1">
                                    <div>
                                        <img src="../public/images/martiheader_0.jpg"/>
                                        <p>Cátedra José Martí</p>
                                    </div>
                                </a>
                            </div>
                            

                            <div class="extension-element col-md-6 col-lg-3">
                                <a style="background-size:cover; justify-content: flex-end; background-image: url('../public/images/catalogo.jpg');" class="extension-container bg-extension2" target="_blank" href="https://docs.google.com/spreadsheets/d/1IMWvKkySg5aHb3dfXgQj-F7HJ1Cdw8qj/edit#gid=498495349">
                                    <div style="color:white; width: 100%; background:rgba(0,0,0,0.7); padding:10px;">
                                        <p class="m-0">Catálogo de biblioteca</p>
                                    </div>
                                </a>

                            </div>
                            <div class="extension-element col-md-6 col-lg-3">
                                <a class="extension-container bg-extension2" target="_blank" href="https://m.youtube.com/channel/UC4Bt7XtTouqXqFTmztzBELA/featured">
                                    <div>
                                        <img src="../public/images/banner desmos youtube-02.jpg"/>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection