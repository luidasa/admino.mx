@extends('layouts.master')

@section('titulo', 'Registro de cuotas de condominos')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registro de cuotas a condominos</h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('last-facturas') }}">Facturas</a></li>
    <li class="breadcrumb-item active">Generar</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Generar los estados de cuenta</div>
        <div class="card-body">
          <form action="{{  route('generate-facturas') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="form-group col">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de inicio" value="@error('fecha_inicio') echo $old->input('fecha_inicio') @enderror" required>
                @error('fecha_inicio')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
              <div class="form-group col">
                <label for="fecha_corte">Fecha de corte</label>
                <input type="date" class="form-control @error('fecha_corte') is-invalid @enderror" id="fecha_corte" name="fecha_corte" value="@error('fecha_corte') echo $old->input('fecha_corte') @enderror" required>
                @error('fecha_corte')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col">
                <label for="fecha_vencimiento">Fecha de vencimiento</label>
                <input type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" id="fecha_vencimiento" name="fecha_vencimiento" value="@error('fecha_vencimiento') echo $old->input('fecha_vencimiento') @enderror" required>
                @error('fecha_vencimiento')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <br>
            <div class="form-group text-right">
              <button class="btn btn-primary">Procesar</button>
            </div>
          </form>

        </div>
</div>
@endsection

