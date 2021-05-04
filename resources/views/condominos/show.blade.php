@extends('layouts.master')

@section('titulo', 'Datos del condominio')

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

