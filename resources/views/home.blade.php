@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row align-items-center">

                @if(Auth::check() && (Auth::user()->rol =='admin'))
                    <div class="col-md-12 ">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">CID - DESMOS</div>
                            <div class="row m-1">

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats ">
                                        <div class="card-header card-header-warning card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">person</i>
                                            </div>
                                            <h3 class="card-title">Investigadores <br></h3>
                                            <a href="{{route('investigadores.create')}}" class="btn btn-outline-success mb-2">Capturar Investigador</a>
                                            <a href="{{route('investigadores.indexAdmin')}}" class="btn btn-outline-danger mb-2">Consultar Investigadores</a>
                                        </div>
                                        <div class="card-footer p-2">
                                            
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-info card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">event</i>
                                                </div>
                                                <h3 class="card-title">Eventos</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route('eventos.create')}}">Capturar Evento</a>
                                                <a href="{{route('eventos.indexAdmin')}}" class="btn btn-outline-danger mb-2">Consultar Eventos</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-success card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">campaign</i>
                                                </div>
                                                <h3 class="card-title">Divulgación</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("divulgaciones.create")}}" >Capturar Publicación</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("divulgaciones.indexAdmin")}}" >Consultar Publicaciones</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-secondary card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">menu_book</i>
                                                </div>
                                                <h3 class="card-title">Libros y capítulos</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("libros.create")}}" >Capturar Libro</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("libros.indexAdmin")}}" >Consultar Libros</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="card card-stats ">
                                            <div class="card-header card-header-info card-header-icon">
                                                <div class="card-icon">
                                                <i class="material-icons">newspaper</i>
                                                </div>
                                                <h3 class="card-title">Artículos en revistas científicas</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("articulos.create")}}">Capturar artículo</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("articulos.indexAdmin")}}">Consultar artículos</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="card card-stats ">
                                            <div class="card-header card-header-info card-header-icon">
                                                <div class="card-icon">
                                                <i class="material-icons">dashboard</i>
                                                </div>
                                                <h3 class="card-title">Quiénes somos</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("quienes-somos.create")}}">Capturar seccion en Quiénes Somos</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("quienes-somos.indexAdmin")}}">Consultar secciones</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="card card-stats ">
                                            <div class="card-header card-header-info card-header-icon">
                                                <div class="card-icon">
                                                <i class="material-icons">contact_mail</i>
                                                </div>
                                                <h3 class="card-title">Contactos</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("contactos.create")}}">Capturar contacto</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("contactos.indexAdmin")}}">Consultar contactos</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="card card-stats ">
                                            <div class="card-header card-header-info card-header-icon">
                                                <div class="card-icon">
                                                <i class="material-icons">group</i>
                                                </div>
                                                <h3 class="card-title">Usuarios</h3>
                                                <a class="btn btn-outline-success mb-2" href="{{route("usuarios.create")}}">Registrar usuarios</a>
                                                <a class="btn btn-outline-danger mb-2" href="{{route("usuarios.indexAdmin")}}">Consultar usuarios</a>
                                            </div>
                                            <div class="card-footer p-2">
                                                
                                            </div>
                                        </div>
                                    </div>

                        
                                {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">logout</i>
                                            </div>
                                            <h3 class="card-title">Salir</h3>
                                            <a class="btn btn-outline-danger" href=""
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                    {{ __('Salir') }}
                                </a>
                                <form id="logout-form" action="" method="POST" class="d-none">
                                    @csrf
                                </form>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
