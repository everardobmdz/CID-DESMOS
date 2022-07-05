<!DOCTYPE html>
<html lang="es-MX" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>DESMOS | Departamento de Estudios Sobre Movimientos Sociales</title>
    <!--
    Favicons
    =============================================
    -->

    <link rel="icon" type="image/png" href="{{asset('/images/desmosIcon.png')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/images/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- CACHE -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <!--
    Stylesheets
    =============================================
    -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



    <!-- Default stylesheets-->
    {{-- <link href="../public/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('/lib/animate.css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/components-font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/et-line-font/et-line-font.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/flexslider/flexslider.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('/lib/owl.carousel/dist/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/owl.carousel/dist/assets/owl.theme.default.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('/lib/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('/lib/simple-text-rotator/simpletextrotator.css')}}" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link id="color-scheme" href="{{asset('/css/colors/default.css')}}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
<main>
    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" role="navigation">
        <a class="navbar-brand" target="_blank" href="http://www.cucsh.udg.mx"><img class="img-fluid" src="{{asset('/images/cucsh.png')}}" width="100" height="auto"></a>
        <a class="navbar-brand" target="_blank" href="{{asset('/')}}"><img class="img-fluid" src="{{asset('/images/logoDesmos.png')}}" width="100" height="auto"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" id="inicio-navlink">
                    <a class="nav-link" href="{{asset('/')}}">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="somos-navlink">
                    <a class="section-scroll nav-link" href="{{route('quienes-somos.index')}}">Quiénes somos</a>
                </li>
                <li class="nav-item" id="investigadores-navlink">
                    <a class="section-scroll nav-link" href="{{route('investigadores.index')}}">Investigadores</a></a>
                </li>
                <li class="nav-item" id="publicaciones-navlink">
                    <a class="section-scroll nav-link" href="{{route('publicaciones.index')}}">Publicaciones</a></a>
                </li>
                <li class="nav-item" id="divulgaciones-navlink">
                    <a class="section-scroll nav-link" href="{{route('divulgaciones.index')}}">Divulgación</a></a>
                </li>
                <li class="nav-item" id="eventos-navlink">
                    <a class="section-scroll nav-link"  href="{{ route('eventos.index') }}">Eventos</a></a>
                </li>
                <li class="nav-item" id="contacto-navlink">
                    <a class="section-scroll nav-link"  href="{{route('contactos.index')}}">Contacto</a></a>
                </li>

                
            </ul>

                
            <form class="form-inline my-2 my-lg-0" action="{{route('busqueda.index')}}" enctype="multipart/form-data">
                <input name="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <img class="img-fluid img-homeDesmos" src="{{asset('/images/desmos.jpg')}}">

    
    @yield('content')


    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#273036" fill-opacity="1" d="M0,288L60,288C120,288,240,288,360,272C480,256,600,224,720,224C840,224,960,256,1080,272C1200,288,1320,288,1380,288L1440,288L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    <div class="infoFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget">
                        <img src="{{asset('/images/escudo_footer.png')}}">
                        <p>CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES</p>
                        <p>Departamento de Estudios sobre Movimientos Sociales (DESMOS)</p>
                        <p>Av. de los Maestros y Av. Alcalde, puerta 1, edificio G, tercer nivel C.P. 44260.</p>
                        <p>Teléfono: (33) 3819-3327</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr class="divider-d">
    <footer class="footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p class="copyright font-alt"><a target="_blank" href="https://www.udg.mx">Universidad de Guadalajara</a></p>
                </div>
                
            </div>
        </div>
    </footer>
    </div>
    <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
</main>
<!--
JavaScripts
=============================================
-->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('/lib/jquery/dist/jquery.js')}}"></script>
{{-- <script src="../public/lib/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="../public/lib/wow/dist/wow.js"></script> --}}
{{-- <script src="../public/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
<script src="../public/lib/isotope/dist/isotope.pkgd.js"></script> --}}
{{-- <script src="../public/lib/imagesloaded/imagesloaded.pkgd.js"></script>
<script src="../public/lib/flexslider/jquery.flexslider.js"></script>
<script src="../public/lib/owl.carousel/dist/owl.carousel.min.js"></script> --}}
<script src="{{asset('/lib/smoothscroll.js')}}"></script>
{{-- <script src="../public/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
<script src="../public/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script> --}}
<script src="{{asset('/js/plugins.js')}}"></script>
<script src="{{asset('/js/main.js')}}"></script>



@yield('modal')
@yield('js-plantilla')
</body>
</html>
