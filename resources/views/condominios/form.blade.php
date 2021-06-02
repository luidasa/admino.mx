@extends('layouts.master')

@section('titulo', 'Modificar los datos del condominio')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{
        !isset($condominio) ?
        'Agregar condominio':
        $condominio->nombre }}
    </h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      @isset ($condominio)
          <li class="breadcrumb-item"><a href="{{ route('panel', ['id' => $condominio->id]) }}">Panel</a></li>
      @else
          <li class="breadcrumb-item"><a href="{{ route('panel') }}">Panel</a></li>
      @endisset
    <li class="breadcrumb-item active">
        @isset($condominio)
        {{$condominio->nombre}}
        @else
        {{'Nuevo condominio'}}
        @endisset</li>
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

    <form action="@isset($condominio){{ route('update-condominio', ['id' => $condominio->id]) }}@else{{route('create-condominio')}}@endisset" method="post">
      @csrf
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control @error('nombre') 'is-invalid' @enderror" id="nombre" name="nombre" placeholder="Nombre del condominio" required
            value="{{ old('nombre') !== null ? old('nombre') : (isset($condominio) ? $condominio->nombre : '') }}">
        @error('nombre')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
        <div class="form-group">
            <label for="direccion">Domicilio</label>
            <textarea rows="4" class="form-control @error('direccion') 'is-invalid' @enderror" id="direccion" name="direccion" required>{{ old('direccion') !== null ? old('direccion') : (isset($condominio) ? $condominio->direccion : '') }}</textarea>
            @error('direccion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
      <div class="row">
        <div class="form-group col">
          <label for="codigo_postal">Codigo postal</label>
          <input type="text" class="form-control @error('codigo_postal') 'is-invalid' @enderror" id="codigo_postal" name="codigo_postal" required
                 value="{{ old('codigo_postal') !== null ? old('codigo_postal') : (isset($condominio) ? $condominio->codigo_postal : '') }}">
            @error('codigo_postal')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
          <div class="form-group col">
              <label for="Estado">Estado</label>
              <input type="text" class="form-control @error('estado') 'is-invalid' @enderror" id="estado" name="estado" placeholder="Estado donde se encuentra" required
                     value="{{ old('estado') !== null ? old('estado') : (isset($condominio) ? $condominio->estado :'') }}">
              @error('estado')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      </div>
        <div class="form-group input-group @error('logotipo') 'is-invalid' @enderror">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Logotipo</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="logotipo" name="logotipo" aria-describedby="inputGroupFileAddon01" accept="image/*">
                <label class="custom-file-label" for="inputGroupFile01">Adjunta el logotipo del Condominio. Este se va a utilizar para los documentos oficiales</label>
            </div>
            @error('logotipo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col">
                <label for="numero_condominos">Numero de condominos a registrar</label>
                <input type="number" min="0" step="1" class="form-control" id="numero_condominos" name="numero_condominos"
                       value="{{ old('numero_condominos') !== null ? old('numero_condominos') : (isset($condominio) ? $condominio->numero_condominos : '') }}">
            </div>
            <div class="form-group col">
                <label for="prefijo_condominos">Prefijo a utilizar</label>
                <input type="text" class="form-control" id="prefijo_condominos" name="prefijo_condominos"
                       value="{{ old('prefijo_condominos') !== null ? old('prefijo_condominos') : 'Interior ' }}">
            </div>
        </div>
      <div class="form-group text-right">
        <button class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
@endsection

