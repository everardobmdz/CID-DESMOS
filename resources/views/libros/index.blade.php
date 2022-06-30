@extends('layouts.plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
            <h2 class="mb-4">Libros y capítulos</h2>
        </div>
    </div>
    @foreach($libros->chunk(4) as $chunk)
        <div class="row">
            @foreach($chunk as $libro)
                <div class="col-md-3 publicaciones">
                    <div class="p-2 w-100 h-100 libro-card">
                        <h6 class="text-center" style="color: #b03124">{{$libro->titulo}}</h6>
                        <p>{!!strip_tags($libro->descripcion)!!}</p>
                        <a href="#" class="btn btn-danger btn-sm active" data-toggle="modal" data-target="#modalLibro-{{$libro->id}}" role="button" aria-pressed="true">Ver Más</a>
                        

                    </div>
                    
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="d-flex">
        {!! $libros->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection

@section('modal')
{{-- Modal --}}
@foreach ($libros as $libro)
    <div class="modal fade" id={{'modalLibro-'.$libro->id}}>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{$libro->titulo}}</h5><br>
                </div>
                <div class="modal-body">
                    <div class="informacionModal">
                        @if($libro->image)
                        <div class="row">
                                <div class="modal-info--item col-md-6">
                                    <b>Detalles del libro: </b>
                                    {!!$libro->descripcion!!}
                                </div>
                                <div class="col-md-6">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal">
                                        <img src="{{url('/storage/images/publicaciones/'.$libro->image)}}"/>
                                    </a>
                                </div>
                                
                            </div>
                        @else
                            <div class="modal-info--item">
                                <b>Detalles del libro: </b>
                                {!!$libro->descripcion!!}
                            </div>
                        @endif
                        <div class="modal-info--item">
                            <b>Año: </b>
                            {{$libro->anio}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              @if($libro->archivos()->where('activo',1)->get()->isNotEmpty())
                                    <h5><b>Archivos adjuntos</b></h5>
                                @endif
                                @foreach($libro->archivos()->where('activo',1)->get() as $archivo)
                                        <div class="file mb-1">
                                            <a target="_blank" href="{{url('storage/files/'.$archivo->path)}}">{{$archivo->path}}</a>
                                        </div>
                
                                @endforeach
                            </div>
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