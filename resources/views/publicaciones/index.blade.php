@extends('layouts.plantilla')
@section('content')
<section class="module" id="publicaciones">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <h2 class="module-title font-alt">Publicaciones</h2>
            </div>
        </div>
        <div class="row">
            <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-6">
                <a href="{{route('libros.index')}}" class="publicaciones-item bg-dark bg-gradient" style='background-image: url("{{asset('/images/libros.jpg')}}")'>
                    <p class="u-non-blurred">Libros y capítulos</p>
                </a>
            </div>
            <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-6" onclick="wow fadeInUp">
                <a href="{{route('articulos.index')}}" class="publicaciones-item bg-dark bg-gradient" style='background-image: url("{{asset('/images/revistas.jpg')}}")'>  
                    <p class="u-non-blurred">Artículos en revistas científicas</p>
                </a >
            </div>
        </div>
    </div>
</section>
@endsection