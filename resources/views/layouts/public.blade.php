<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield( 'titulo' ) - Admino</title>
    @section('header')

        <link href="/css/styles.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
        <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png"/>
        <script data-search-pseudo-elements defer
                src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"
                crossorigin="anonymous"></script>

    @show
</head>
<body>

<body>
<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>
            <nav class="navbar navbar-marketing navbar-expand-lg bg-primary navbar-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand text-white" href="{{ route('home') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="36" class="d-block"
                             viewBox="0 0 612 612" role="img" focusable="false">
                            <title>Admino</title>
                            <path fill="currentColor"
                                  d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"></path>
                            <path fill="currentColor"
                                  d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"></path>
                        </svg>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item {{ Route::currentRouteName() == 'panel' ? 'active': '' }}">
                                    <a class="nav-link " aria-current="page" href="{{route('panel')}}">Panel</a>
                                </li>
                                @if (session('condominio_id'))
                                    <li class="nav-item dropdown {{ str_contains(Route::currentRouteName(), 'condomino') ? 'active': '' }}">
                                        <a class="nav-link" class="nav-link dropdown-toggle" href="#"
                                           id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            Condominos
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item"
                                               href="{{ route('condominos', ['condominio_id' => session('condominio_id')]) }}">Condominos {{session('condominio_id')}}</a>
                                            <a class="dropdown-item" href="{{ route('last-facturas') }}">Estados de
                                                cuenta</a>
                                            <a class="dropdown-item" href="{{ route('cargos-generales') }}">Noticias</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown {{ str_contains(Route::currentRouteName(), 'administracion') ? 'active': '' }}">
                                        <a class="nav-link" class="nav-link dropdown-toggle" href="#"
                                           id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            Condominio
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('proyectos') }}">Proyectos</a>
                                            <a class="dropdown-item" href="{{ route('quejas') }}">Quejas</a>
                                            <a class="dropdown-item" href="{{ route('documentos') }}">Documentos</a>
                                            <a class="dropdown-item"
                                               href="{{ route('reservaciones') }}">Reservaciones</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown {{ str_contains(Route::currentRouteName(), 'configuracion') ? 'active': '' }}">
                                        <a class="nav-link" class="nav-link dropdown-toggle" href="#"
                                           id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            Configuraci??n
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('configuracion')}}">Generales</a>
                                            <a class="dropdown-item" href="{{ route('cargos-generales') }}">Cargos
                                                recurrentes</a>
                                        </div>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav justify-content-end">
                                @auth
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('condominios') }}">Condominios</a>
                                            <a class="dropdown-item" href="{{ route('profile')  }}">Perfil</a>
                                            <a class="dropdown-item" href="#">Preferencias</a>
                                            <div class="dropdown-divider"></div>
                                            <div class="dropdown-item">
                                                <a class="dropdown-item" href="{{ route('logout') }}">Salir</a>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Iniciar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Registro</a>
                                    </li>
                                @endauth

                            </ul>
                        </div>

                    </div>
                </div>
            </nav>

            @section('encabezado')
            @show

            @section('contenido')
            @show
        </main>
    </div>
    <div id="layoutDefault_footer">
        <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer-brand">Admino.mx</div>
                        <div class="mb-3">Administraci??n y mantenimiento de Condominios</div>
                        <div class="icon-list-social mb-5">
                            <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a><a
                                class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a><a
                                class="icon-list-social-link" href="javascript:void(0);"><i
                                    class="fab fa-github"></i></a><a class="icon-list-social-link"
                                                                     href="javascript:void(0);"><i
                                    class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                <div class="text-uppercase-expanded text-xs mb-4">Product</div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><a href="javascript:void(0);">Landing</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Pages</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Sections</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                    <li><a href="javascript:void(0);">Changelog</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                <div class="text-uppercase-expanded text-xs mb-4">Technical</div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Changelog</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Theme Customizer</a></li>
                                    <li><a href="javascript:void(0);">UI Kit</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                <div class="text-uppercase-expanded text-xs mb-4">Includes</div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><a href="javascript:void(0);">Utilities</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Components</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Layouts</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Code Samples</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Products</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Affiliates</a></li>
                                    <li><a href="javascript:void(0);">Updates</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><a href="javascript:void(0);">Privacy Policy</a></li>
                                    <li class="mb-2"><a href="javascript:void(0);">Terms and Conditions</a></li>
                                    <li><a href="javascript:void(0);">License</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5"/>
                <div class="row align-items-center">
                    <div class="col-md-6 small">Copyright &copy; Your Website 2020</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="javascript:void(0);">Privacy Policy</a>
                        &middot;
                        <a href="javascript:void(0);">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="/js/scripts.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        disable: 'mobile',
        duration: 600,
        once: true
    });
</script>


</body>
</html>
