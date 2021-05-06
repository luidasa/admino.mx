<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield( 'titulo' ) - Admino</title>
    @section('header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7acce89201.js" crossorigin="anonymous"></script>
    @show
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="d-block" viewBox="0 0 612 612" role="img" focusable="false">
        <title>Admino</title>s
        <path fill="currentColor" d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"></path>
        <path fill="currentColor" d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"></path>
    </svg>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
        @auth
        <li class="nav-item {{ Route::currentRouteName() == 'panel' ? 'active': '' }}">
          <a class="nav-link " aria-current="page" href="{{route('panel')}}">Panel</a>
        </li>
        <li class="nav-item {{ str_contains(Route::currentRouteName(), 'condomino') ? 'active': '' }}">
          <a class="nav-link" href="{{route('condominos')}}">
            Condominos
          </a>
        </li>
        <li class="nav-item {{ str_contains(Route::currentRouteName(), 'proyectos') ? 'active': '' }}">
          <a class="nav-link" href="{{ route('proyectos') }}">
            Proyectos
          </a>
        </li>
        <li class="nav-item {{ str_contains(Route::currentRouteName(), 'queja') ? 'active': '' }}">
          <a class="nav-link" href="{{route('quejas')}}">
            Quejas
          </a>
        </li>
        <li class="nav-item {{ str_contains(Route::currentRouteName(), 'documento') ? 'active': '' }}">
          <a class="nav-link" href="{{route('documentos')}}">
            Documentos
          </a>
        </li>
        @endauth
        </ul>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav justify-content-end">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Perfil</a>
                <a class="dropdown-item" href="#">Preferencias</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Salir</a>
              </div>
            </li>
          @else
            <li class="nav-item">            
              <a href="{{ route('login') }}" class="nav-link">Iniciar</a>
            </li>

            @if (Route::has('register'))
              <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Registro</a>
              </li>
            @endif
          @endauth
  
        </ul>
    </div>
  </div>
</nav>

<div class="container mt-3">

@section('camino')
@show

<h1>@yield('titulo')</h1>

@section('feedback')
  @if (session('alert-primary') !== null)
  <div class="alert alert-primary" role="alert">
    {{session('alert-primary')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-secondary') !== null)
  <div class="alert alert-secondary" role="alert">
    {{session('alert-secondary')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-success') !== null)
  <div class="alert alert-success" role="alert">
    {{session('alert-success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-danger') !== null)
  <div class="alert alert-danger" role="alert">
  {{session('alert-danger')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-warning') !== null)
  <div class="alert alert-warning" role="alert">
    {{session('alert-warning')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-info') !== null)
  <div class="alert alert-info" role="alert">
    {{session('alert-info')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-light') !== null)
  <div class="alert alert-light" role="alert">
    {{session('alert-light')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
  @if (session('alert-dark'))
  <div class="alert alert-dark" role="alert">
    {{session('alert-dark')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> 
  </div>
  @endif
@show

@section('contenido')
@show
</div>


@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
@show
</body>
</html>