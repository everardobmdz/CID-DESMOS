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
                    <h2>Captura de contacto</h2>
                </div>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });

                </script>

            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('contactos.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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
                                <label class="font-weight-bold" for="titulo">Nombre* </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            </div>
                            
                        </div>
                        
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="titulo">Correo </label>
                                <input type="text" class="form-control" id="correo" name="correo" value="{{ old('correo') }}">
                            </div>
                            
                        </div>
                        
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="titulo">Teléfono </label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
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

@section('css')
        <style>
            .containerImgCreate{
                margin: 1.5em;
                width: 150px;
                height: 200px;
                position: relative;
                overflow: hidden;
            }
            
            #createInvesPic{
                width: 100%;
                position: absolute;
                object-fit: contain;
            }
            
        </style>

@endsection