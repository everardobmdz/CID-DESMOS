@extends('layouts.app')
@section('content')
<div class="container">
    @if (Auth::check() && Auth::user()->rol == 'admin')
        @if (session('message'))
            <div class="alert alert-success">
                <h2>{{ session('message') }}</h2>

            </div>
        @endif

        <div class="row">
            <div class="col-md-auto ml-3">
                <h2>Captura de post de divulgacion</h2>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('divulgaciones.store') }}" method="post" enctype="multipart/form-data" class="col-12">
                    {!! csrf_field() !!}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                Debe de llenar los campos marcados con un asterisco (*).
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <label class="font-weight-bold" for="titulo">Titulo* </label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
                        </div>
                        
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <label class="font-weight-bold" for="descripcion">Descripcion* </label>
                            <textarea class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label class="font-weight-bold" for="fecha">Fecha* </label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}">
                        </div>
                        
                    </div>

                    <br>
                    <div class="row align-items-center mb-3">
                        <div class="col-md-5">
                            <label class="font-weight-bold" for="fecha">Link </label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                        </div>
                        
                    </div>
                    <br>

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="files[]">Archivos </label>
                            <input class="form-control" accept="image/*,.pdf,.doc,.docx,.xlsx" type="file" name="files[]" multiple>
                        </div>
                        
                    </div>
                    
                    
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                Guardar datos
                                <i class="ml-1 fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
        <br>
        <div class="row align-items-center">

            <br>
            <hr>
            <h5>Departamento de Estudios sobre Movimientos Sociales. DESMOS</h5>
        </div>
</div>

@else
    Acceso denegado
@endif

@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    
@endsection