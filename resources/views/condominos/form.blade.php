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

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Modificar condomino</div>
        <div class="card-body">

          <form action="{{ route('edit-condomino', ['id' => $condomino->id]) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="duenio">Dueño</label>
              <input type="text" class="form-control" id="duenio" name="duenio" placeholder="Nombre del dueño" required value="{{ $condomino->duenio }}">
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="telefono">Teléfono</label>
                <input type="text" maxlength="14" class="form-control" id="telefono" name="telefono" placeholder="(999) 999 9999" value="{{ $condomino->telefono }}" required>
              </div>
              <div class="form-group col">
                <label for="email">Correo</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ $condomino->email }}">
              </div>
            </div>
            <div class="row">
            <div class="form-group col">
              <label for="residente">Residente</label>
              <input type="text" class="form-control" id="residente" name="residente" placeholder="Nombre de la persona que habita la casa" value="{{ $condomino->residente }}">
            </div>
              <div class="form-group col">
                <label for="figura">Relación</label>
                <select class="form-control" id="figura" name="figura">
                  <option value="">-- Seleccione si el dueño no es el residente--</option>
                  <option {{ $condomino->figura === 'Renta' ? 'selected' : '' }}>Renta</option>
                  <option {{ $condomino->figura === 'Familiar' ? 'selected' : '' }}>Familiar</option>
                  <option {{ $condomino->figura === 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
              </div>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="true" id="desocupada" name="desocupada" {{ $condomino->desocupada !== null && $condomino->desocupada ? 'checked' : '' }}>
              <label class="form-check-label" for="desocupada">
                Esta desocupada
              </label>
            </div>
            <hr>
            <div class="form-group text-right">
              <a href="{{ route('pagos', ['condomino_id' => $condomino->id]) }}" class="btn btn-primary">Pagos</a>
              <button class="btn btn-primary">Guardar</button>
            </div>
          </form>

        </div>
</div>
@endsection

