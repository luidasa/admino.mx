@extends('layouts.public')

@section('titulo', 'Modificar los datos del condomino')

@section('encabezado')

    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Modificación a {{ $condomino->interior }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('camino')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('condominos', ['condominio_id' => session('condominio_id')]) }}">Condominos</a></li>
            <li class="breadcrumb-item active">{{ $condomino->interior }}</li>
        </ol>
    </nav>
@endsection

@section('feedback')
    @parent
@endsection

@section('contenido')
    <section class="bg-light pb-3 pt-3">
        <div class="container">

            <div class="card">
                <form
                    action="{{ route('edit-condomino', ['condominio_id'=> session('condominio_id'), 'id' => $condomino->id]) }}"
                    method="post">
                    @csrf

                    <div class="card-header">Modificar condomino</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="duenio">Dueño</label>
                            <input type="text" class="form-control" id="duenio" name="duenio"
                                   placeholder="Nombre del dueño" required value="{{ old('duenio') ? old('duenio') : $condomino->duenio }}">
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="interior">Interior</label>
                                <input type="text" maxlength="20" class="form-control" id="interior" name="interior"
                                       placeholder="Numero interior o casa" value="{{ old('interior') ? old('interior') : $condomino->interior }}" required>
                            </div>
                            <div class="form-group col">
                                <label for="telefono">Teléfono</label>
                                <input type="text" maxlength="14" class="form-control" id="telefono" name="telefono"
                                       placeholder="(999) 999 9999" value="{{ old('telefono') ? old('telefono') : $condomino->telefono }}" required>
                            </div>
                            <div class="form-group col">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                       value="{{ old('email') ? old('email') : $condomino->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="residente">Residente</label>
                                <input type="text" class="form-control" id="residente" name="residente"
                                       placeholder="Nombre de la persona que habita la casa"
                                       value="{{ old('residente') ? old('residente') : $condomino->residente }}">
                            </div>
                            <div class="form-group col">
                                <label for="figura">Relación</label>
                                <select class="form-control" id="figura" name="figura">
                                    <option value="">-- Seleccione si el dueño no es el residente--</option>
                                    <option {{ (old('figura') ? old('figura') : $condomino->figura) === 'Renta' ? 'selected' : '' }}>Renta</option>
                                    <option {{ (old('figura') ? old('figura') : $condomino->figura) === 'Familiar' ? 'selected' : '' }}>Familiar</option>
                                    <option {{ (old('figura') ? old('figura') : $condomino->figura) ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="desocupada"
                                   name="desocupada" {{ (old('desocupada') ? old('desocupada') : $condomino->desocupada !== null && $condomino->desocupada) ? 'checked' : '' }}>
                            <label class="form-check-label" for="desocupada">
                                Esta desocupada
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group text-right">
                            <a href="{{ route('cargos', ['condominio_id' => session('condominio_id'), 'condomino_id' => $condomino->id]) }}"
                               class="btn btn-primary">Cargos</a>
                            <a href="{{ route('pagos', ['condominio_id' => session('condominio_id'), 'condomino_id' => $condomino->id]) }}"
                               class="btn btn-primary">Pagos</a>
                            <button class="btn btn-primary">Guardar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

