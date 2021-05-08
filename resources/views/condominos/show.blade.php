@extends('layouts.master')

@section('titulo', 'Datos del condominio')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Información del condomino</h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('condominos') }}">Condominos</a></li>
    <li class="breadcrumb-item active">{{ $condomino->interior }}</li>
  </ol>
</nav>
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Condominios registrados</div>
        <div class="card-body">
        Aqui va el formulario para mostrar la casa.
        </div>
</div>
@endsection

