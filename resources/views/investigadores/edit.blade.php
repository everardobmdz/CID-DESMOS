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
                    <h2>Edición de investigador</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{route('investigadores.update',$investigador->id)}}" method="post" enctype="multipart/form-data" class="col-12">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
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
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="nombre">Nombre(s)* </label>
                                <input value="{{$investigador->nombre}}" type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="nombre">Apellido* </label>
                                <input value="{{$investigador->apellido}}" type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="linea_investigacion">Linea de investigación* </label>
                                <input value="{{$investigador->lineasInves}}" type="text" class="form-control" id="linea_investigacion" name="linea_investigacion" value="{{ old('linea_investigacion') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="grado">Grado*</label>
                                <select class="form-control" id="grado" name="grado">
                                    <option value="{{$investigador->grado}}" selected>{{$investigador->grado}}</option>
                                    <option value="Maestro">Maestro</option>
                                    <option value="Maestra">Maestra</option>
                                    <option value="Maestrante">Maestrante</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Doctora">Doctora</option>
                                    <option value="Doctorante">Doctorante</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="correo">Reconocimientos* </label>
                                <input value="{{$investigador->reconocimientos}}" type="text" class="form-control" id="reconocimientos" name="reconocimientos" value="{{ old('reconocimientos') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="proyecto_invest">Proyecto de investigación en proceso </label>
                                <input value="{{$investigador->proyecto_invest}}" type="text" class="form-control" id="proyecto_invest" name="proyecto_invest" value="{{ old('proyecto_invest') }}">
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="area">Publicaciones*</label>
                                <input value="{{$investigador->publicaciones}}" type="text" class="form-control" id="publicaciones" name="publicaciones" value="{{ old('publicaciones') }}">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="correo">Correo:* </label>
                                <input value="{{$investigador->correo}}" type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}">
                            </div>

                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="containerImgCreate">
                                    @if(Storage::disk('images-investigadores')->has($investigador->image))
                                        <img id="createInvesPic" src="{{url('/storage/images/investigadores/'.$investigador->image)}}"/>
                                    @else
                                        <img id="createInvesPic" src="../../../public/images/defaultPicture.png">
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="imagen">Imagen</label>
                                <div class="custom-file">
                                    <input name="imagen" type="file" class="custom-file-input" id="customFileLang" accept="image/*"
                                           lang="es">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <a href="{{route('investigadores.indexAdmin')}}" class="btn btn-danger">Cancelar</a>
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
@stop

@section('js')
    <script>
        document.getElementById("customFileLang").addEventListener('change',cambiarImagen);
        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) =>{
                document.getElementById('createInvesPic').setAttribute('src',event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection