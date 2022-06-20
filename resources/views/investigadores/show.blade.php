@extends('layouts.plantilla')
@section('content')
<div class="modal-content">
    <div class="modal-header">
        <div class="img-border-rounded">
            @if(Storage::disk('images-investigadores')->has($investigador->image))
                <a href="#" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{url('/storage/images/investigadores/'.$investigador->image)}}"/>
                </a>
            @endif
        </div>
        <h1>{{$investigador->nombre.' '.$investigador->apellido}}</h1><br>
    </div>
    <div class="modal-body">
        <div class="container">
            @if($investigador->reconocimientos)
            <div class="card-icon text-center">
                <i class="material-icons">military_tech</i>
            </div>
            <h5 class="text-center">Reconocimientos</h5>
            <p class="text-center">{{$investigador->reconocimientos}}</p>
                
            @endif
            @if($investigador->proyecto_invest)
                <div class="card-icon text-center">
                    <i class="material-icons">history_edu</i>
                </div>
                <h5 class="text-center">Proyecto de investigación en proceso</h5>
                <p class="text-center">{{$investigador->proyecto_invest}}</p>

            @endif
            <div class="modal-info--item">
                <div class="card-icon text-center">
                    <i class="material-icons">newspaper</i>
                </div>
                <h5 class="text-center">Publicaciones</h5>
                <p class="text-center">{{$investigador->publicaciones}}</p>
            </div>
            <div class="modal-info--item">
                <div class="card-icon text-center">
                    <i class="material-icons">contact_mail</i>
                </div>
                <h5 class="text-center">Contacto</h5>
                <p class="text-center">{{$investigador->correo}}</p>
            </div>
            <div class="modal-info--item">
                <div class="card-icon text-center">
                    <i class="material-icons">school</i>
                </div>
                <h5 class="text-center">Grado</h5>
                <p class="text-center">{{$investigador->grado}}</p>
            </div>
            <div class="modal-info--item">
                <div class="card-icon text-center">
                    <i class="material-icons">plagiarism</i>
                </div>
                
                <h5 class="text-center">Línea de investigación</h5>
                <p class="text-center">{{$investigador->lineasInves}}</p>

            </div>
            
            
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
            <img src="{{url('/storage/images/investigadores/'.$investigador->image)}}"/>

        </div>
      </div>
    </div>
</div>
@endsection