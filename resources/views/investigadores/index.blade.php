@extends('layouts.plantilla')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
            <h2 class="mb-4">Investigadores</h2>
        </div>
    </div>
    @foreach($investigadores->chunk(4) as $chunk)
        <div class="row justify-content-start">
            @foreach ($chunk as $investigador)    
                <div class="col-sm-3 ">
                    <div class="p-3 investigador-card w-100">

                        <div class="img-border-rounded">
                            @if(Storage::disk('images-investigadores')->has($investigador->image))
                                <img src="{{url('/storage/images/investigadores/'.$investigador->image)}}"/>
                            @endif
            
                        </div>
                        <div class="investigadores-card--info">
                            @if(strlen($investigador->nombre.' '.$investigador->apellido)>36)
                                <h4>{{substr(($investigador->nombre.' '.$investigador->apellido),0,36).'...'}}</h4>
                            @else
                                <h4>{{$investigador->nombre.' '.$investigador->apellido}}</h4>
                            @endif
                            <h5>{{$investigador->grado}}</h5>
                            <h6>Linea de investigación: <i>{{substr($investigador->lineasInves,0,63).'...'}}</i></h6>
                        </div>
                        <br>
                        <button type="button" class="btn btn-info btnModal" data-toggle="modal" data-target="#modalInvest-{{$investigador->id}}">Info</button>
                    </div>
                
                </div>
            @endforeach
    
        </div>
    @endforeach
    <div class="d-flex">
        {!! $investigadores->links() !!}
    </div>
</div>
@endsection

@section('modal')
{{-- Modal --}}
@foreach ($investigadores as $investigador)
    <div class="modal fade" id={{'modalInvest-'.$investigador->id}}>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="img-border-rounded">
                        @if(Storage::disk('images-investigadores')->has($investigador->image))
                            <img src="{{url('/storage/images/investigadores/'.$investigador->image)}}"/>
                        @endif
                    </div>
                    <h1>{{$investigador->nombre.' '.$investigador->apellido}}</h1><br>
                </div>
                <div class="modal-body">
                    <div class="informacionModal">
                        @if($investigador->reconocimientos)
                            <div class="modal-info--item">
                                <b>Reconocimientos: </b> {{$investigador->reconocimientos}}
                            </div>
                        @endif
                        @if($investigador->proyecto_invest)
                            <div class="modal-info--item">
                                <b>Proyecto de investigación en proceso: </b> {{$investigador->proyecto_invest}}
                            </div>
                        @endif
                        <div class="modal-info--item">
                            <b>Publicaciones: </b>
                            {{$investigador->publicaciones}}
                        </div>
                        <div class="modal-info--item">
                            <b>Contacto: </b>
                            {{$investigador->correo}}
                        </div>
                        <div class="modal-info--item">
                            <b>Grado: </b>
                            {{$investigador->grado}}
                        </div>
                        <div class="modal-info--item">
                            <b>Lineas de investigación: </b>
                            {{$investigador->lineasInves}}
                        </div>
                        
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
        
    </div>
@endforeach


@endsection