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
                    <h2>Captura de Evento</h2>
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
                    <form action="{{ route('eventos.update',$evento->id)}}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="titulo">Titulo* </label>
                                <input value="{{$evento->titulo}}" type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripcion">Descripcion* </label>
                                <textarea class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}">{{$evento->descripcion}}</textarea>
                            </div>
                        </div>

                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="fecha">Fecha* </label>
                                <input value="{{explode(" ",$evento->fecha)[0]}}" type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center form-check form-switch">
                            <div class="col-md-12">

                                <input name="is_solo_noticia" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" @if($evento->is_solo_noticia)checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Mostrar solamente en noticias</label>
                            </div>
                        </div>  
                        
                        <br>
                        @if($archivos->isNotEmpty())
                            <h2>Archivos</h2>
                        @endif
                        @foreach($archivos as $archivo)
                            <div class="file">
                                <a target="_blank" href="{{url('storage/files/'.$archivo->path)}}">{{$archivo->path}}</a><a href="{{ route('delete-archivo',$archivo->id) }}" class="delete-file btn btn-danger m-2">x</a>
                            </div>

                        @endforeach
                        <br>

                        <div class="row align-items-center">
                            
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="imagen">Imagen</label>
                                <div class="custom-file">
                                    <input name="imagen" type="file" class="custom-file-input" id="customFileLang" accept="image/*"
                                           lang="es">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="containerImgCreate">
                                    @if(Storage::disk('images-eventos')->has($evento->image))
                                        <img id="createInvesPic" src="{{url('/storage/images/eventos/'.$evento->image)}}"/>
                                    @else
                                        <img id="createInvesPic" src="../../../public/images/defaultPicture.png">
                                    @endif

                                </div>
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
                                <a href="{{ route('eventos.indexAdmin') }}" class="btn btn-danger">Cancelar</a>
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

@section('scripts')
<script></script>
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
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
    <script>
        ClassicEditor
            .create( document.querySelector( '#descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function(){
            
            // Find and remove selected table rows
            $(".delete-file").click(function(){
                $(this).parent().remove();
            });
        });   
    </script>
@endsection