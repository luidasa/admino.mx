@extends('layouts.master')

@section('titulo', 'Registro de cuotas generales a condominos')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@isset($cargo) {{ $cargo->concepto }} @else Registrar nueva cuota @endisset</h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cargos-generales') }}">Cuotas generales</a></li>
    <li class="breadcrumb-item active">@isset($cargo) {{ $cargo->concepto }} @else Nueva @endisset</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Registrar cargo general</div>
        <div class="card-body">
          <form action="@isset($cargo->id) {{ route('edit-cargo-general', ['id' => $cargo->id]) }} @else {{ route('create-cargo-general') }} @endisset" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="form-group col">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                  id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de Inicio" 
                  value="{{ isset($old) ? $old->input('fecha_inicio') : date('Y-m-d', strtotime($cargo->fecha_inicio))}}" required>
                @error('fecha_inicio')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
              <div class="form-group col">
                <label for="repeticiones">Repeticiones</label>
                <input type="number" step="1" min="1" max="12" class="form-control @error('repeticiones') is-invalid @enderror" 
                  id="repeticiones" name="repeticiones" placeholder="Numero de repeticiones" 
                  value="{{ isset($old) ? $old->input('repeticiones') : $cargo->repeticiones }}" required>
                @error('repeticiones')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
              <div class="form-group col">
                <label for="periodicidad">Periodicidad</label>
                <select class="form-control @error('periodicidad') is-invalid @enderror" id="periodicidad" name="periodicidad">
                    <option value="">-- Seleccione cada cuando se va a cobrar--</option>
                    <option value="0" {{ (isset($old) && ($old->input('repeticiones') === s0)) ? "selected" : (($cargo->repeticiones === 0) ? "selected" : '') }}>Unica</option>
                    <option value="1" {{ (isset($old) && ($old->input('repeticiones') === 1)) ? "selected" : (($cargo->repeticiones === 1) ? "selected" : '') }}>Mensual</option>
                    <option value="2" {{ (isset($old) && ($old->input('repeticiones') === 2)) ? "selected" : (($cargo->repeticiones === 2) ? "selected" : '') }}>Bimestral</option>
                    <option value="3">Trimestral</option>
                    <option value="6">Semestral</option>
                    <option value="12">Anual</option>
                  </select>
                @error('periodicidad')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="importe">Importe</label>
                <input type="decimal" maxlength="14" 
                  class="form-control @error('importe') is-invalid @enderror" 
                  id="importe" name="importe" placeholder="Importe de la cuota recurrente" 
                  value="{{ isset($old) ? $old->input('importe') : $cargo->importe }}" required>
                @error('importe')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col">
                <label for="descuento_por_desocupada">Descuento por desocupada</label>
                <input type="decimal" min="0" max="100" step="1" 
                  class="form-control @error('descuento_por_desocupada') is-invalid @enderror" 
                  id="descuento_por_desocupada" name="descuento_por_desocupada" placeholder="Descuento si esta desocupada" 
                  value="{{ isset($old) ? $old->input('descuento_por_desocupada') : $cargo->descuento_por_desocupada }}" required>
                @error('descuento_por_desocupada')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col">
                <label for="concepto">Concepto</label>
                <select class="form-control @error('concepto') is-invalid @enderror" id="concepto" name="concepto">
                  <option value="">-- Seleccione el concepto del cargo--</option>
                  <option>Mantenimiento</option>
                  <option>Seguridad</option>
                  <option>Extraordinaria</option>
                  <option>Otro</option>
                </select>
                @error('concepto')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea name="descripcion" id="description" cols="80" rows="3" class="form-control"></textarea>        
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Adjuntar comprobante</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('comprobante') is-invalid @enderror" id="comprobante" name="comprobante" aria-describedby="inputGroupFileAddon01" accept="image/*,application/pdf">
                <label class="custom-file-label" for="inputGroupFile01">Elige el archivo con el comprobante</label>
                @error('comprobante')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <br>
            <div class="form-group text-right">
              <button class="btn btn-primary">Generar calendario</button>
            </div>
          </form>

        </div>
</div>
@endsection

