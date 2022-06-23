@extends('layouts.plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
            <h2 class="mb-4">Artículos en revistas científicas</h2>
        </div>
    </div>
    @foreach($articulos->chunk(4) as $chunk)
        <div class="row">
            @foreach($chunk as $articulo)
                <div class="col-md-3 publicaciones">
                    <div class="p-2 w-100 h-100 libro-card">
                        <h6 class="text-center" style="color: #273036">{{$articulo->titulo}}</h6>
                        <p>{!!strip_tags($articulo->descripcion)!!}</p>
                        <a href="#" class="btn btn-danger btn-sm active" data-toggle="modal" data-target="#modalArticulo-{{$articulo->id}}" role="button" aria-pressed="true">Ver Más</a>
                        

                    </div>
                    
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="d-flex">
        {!! $articulos->links('pagination::boostrap-4') !!}
    </div>
</div>

@endsection

@section('modal')
{{-- Modal --}}
@foreach ($articulos as $articulo)
    <div class="modal fade" id={{'modalArticulo-'.$articulo->id}}>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{$articulo->titulo}}</h5><br>
                </div>
                <div class="modal-body">
                    <div class="informacionModal">
                        <div class="modal-info--item">
                            <b>Detalles del artículo: </b>
                            {!!$articulo->descripcion!!}
                        </div>
                        <div class="modal-info--item">
                            <b>Año: </b>
                            {{$articulo->anio}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if($articulo->archivos()->where('activo',1)->get()->isNotEmpty())
                                    <h5><b>Archivos adjuntos</b></h5>
                                @endif
                                @foreach($articulo->archivos()->where('activo',1)->get() as $archivo)
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