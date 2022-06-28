@extends('layouts.plantilla')
@section('content')

<div class="mt-5 text-center">
    <span style="font-size: 50px;" class="material-icons">newspaper</span>
</div>
<h3 class="text-center">{{$articulo->titulo}}</h3>
<div class="container">
    <p>{!!$articulo->descripcion!!}</p>
    <div class="row">
        @if($articulo->image)
            <div class="col-md-12">
                <a href="#" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{url('/storage/images/publicaciones/'.$articulo->image)}}"/>
                </a>
            </div>
        @endif
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

@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{url('/storage/images/publicaciones/'.$articulo->image)}}">
        </div>
      </div>
    </div>
</div>
@endsection