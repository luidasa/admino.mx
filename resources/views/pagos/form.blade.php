@extends('layouts.master')

@section('titulo', 'Registro de cuotas de condominos')

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('condominos') }}">Condominos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('edit-condomino', [ 'id' => $condomino->id]) }}">{{ $condomino->interior }}</a></li>
    <li class="breadcrumb-item active">Registrar pago</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Registrar pago del condominio</div>
        <div class="card-body">

          <form action="{{ !isset($pago) ? route('create-pago', ['condomino_id' => $condomino->id]) : route('edit-pago', ['id' => $pago->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="form-group col">
              <label for="pagado_el">Fecha de pago</label>
              <input type="date" class="form-control @error('pagado_el') is-invalid @enderror" id="pagado_el" name="pagado_el" placeholder="Fecha de pago" value="@error('pagado_el') echo old->input('pagado') @enderror" required>
              @error('pagado_el')
                <div class="invalid-feedback">{{ $message }}</div>
             @enderror
            </div>
              <div class="form-group col">
                <label for="importe">Importe</label>
                <input type="decimal" maxlength="14" class="form-control @error('importe') is-invalid @enderror" id="importe" name="importe" placeholder="Importe pagado" required>
                @error('importe')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col">
                <label for="forma">Forma de pago</label>
                <select class="form-control @error('forma') is-invalid @enderror" id="forma" name="forma">
                  <option value="">-- Seleccione si la forma de pago--</option>
                  <option>Deposito (OXXO, Banco, otro)</option>
                  <option>Transferencia</option>
                  <option>Efectivo</option>
                </select>
                @error('forma')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="referencia">Referencia</label>
              <textarea name="referencia" id="referencia" cols="80" rows="5" class="form-control @error('referencia') is-invalid @enderror"></textarea>
              @error('referencia')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
              <button class="btn btn-primary">Guardar</button>
            </div>
          </form>

        </div>
</div>
@endsection

