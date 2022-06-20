@extends('layouts.plantilla')
@section('content')
    <div class="container eventos" style="margin-top:4.5em">

        @foreach($eventos as $evento)
            <div class="evento-container">
                <h3><a data-toggle="tooltip" title="{{$evento->titulo}}" href="{{route('eventos.show',$evento)}}">{{strlen($evento->titulo) < 108? $evento->titulo : substr($evento->titulo,0,105).'...'}}</a></h3>
                <p>{!!substr(strip_tags($evento->descripcion),0,305).'...'!!}</p>
                <h4>
                    <?php
                        $cola = "";
                    
                        $date = new DateTime(explode(" ", $evento->fecha)[0]);
                        $dateFormated = $date->getTimestamp();
                        
                        setlocale(LC_TIME,'esm.UTF-8');
                        echo strftime("%A, %d de %B de %Y", $dateFormated)
                        
                    ?>
                </h4>
                <img src="{{url('/storage/images/eventos/'.$evento->image)}}" alt="">
            </div>
            


        @endforeach

        <div class="d-flex">
            {!! $eventos->links() !!}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection