@extends('layouts.plantilla')

@section('content')
<div class="container busqueda-container mt-5 pt-5">
    <h1>Resultados de búsqueda: {{$busqueda}}</h1>
    <h6>{{count($resultados).' coincidencias'}}</h6>
    @foreach($resultados as $resultado)
        <div class="row">
            <div class="col-sm-12">
                <a href="{{route($resultado['route'],$resultado['id'])}}"><h6>{{$resultado['titulo']}}</h6></a>
                <p>{!!$resultado['descripcion']!!}</p>
            </div>
        </div>
    @endforeach
    <div class="d-flex">
        {!! $resultados->links('pagination::bootstrap-4') !!}
    </div>

</div>

@endsection