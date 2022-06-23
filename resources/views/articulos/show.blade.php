@extends('layouts.plantilla')
@section('content')

<div class="mt-5 text-center">
    <span style="font-size: 50px;" class="material-icons">newspaper</span>
</div>
<h3 class="text-center">{{$articulo->titulo}}</h3>
<div class="container w-50">
    <p>{!!$articulo->descripcion!!}</p>
    <div class="row">
        <div class="col-md-12">
            @if($archivos->isNotEmpty())
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