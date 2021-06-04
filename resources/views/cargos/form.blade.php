@extends('layouts.public')

@section('titulo', 'Registro de cuotas de condominos')

@section('encabezado')
    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Registro de cuota a {{ $condomino->interior  }}</h1>
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
            <li class="breadcrumb-item"><a
                    href="{{ route('edit-condomino', ['condominio_id' => session('condominio_id'), 'id' => $condomino->id]) }}">{{ $condomino->interior }}</a>
            </li>
            <li class="breadcrumb-item active">Registrar Cargo</li>
        </ol>
    </nav>
@endsection

@section('feedback')
    @parent
@endsection

@section('contenido')
    <section class="bg-light pt-3 pb-3">
        <div class="container">

            <div class="card">
                <div class="card-header">Registrar cargo del condominio</div>
                <div class="card-body">
                    <form action="{{ !isset($cargo) ?
                route('create-cargo', ['condominio_id' => session('condominio_id'), 'condomino_id' => $condomino->id]) :
                route('edit-cargo', ['condominio_id' => session('condominio_id'), 'id' => $cargo->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="fecha_vencimiento">Fecha de vencimiento</label>
                                <input type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                                       id="fecha_vencimiento" name="fecha_vencimiento"
                                       placeholder="Fecha de vencimiento"
                                       value="@error('fecha_vencimiento') echo old->input('fecha_vencimiento') @enderror"
                                       required>
                                @error('fecha_vencimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="importe">Importe</label>
                                <input type="decimal" maxlength="14"
                                       class="form-control @error('importe') is-invalid @enderror" id="importe"
                                       name="importe" placeholder="Importe pagado" required>
                                @error('importe')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="concepto">Concepto</label>
                                <select class="form-control @error('concepto') is-invalid @enderror" id="concepto"
                                        name="concepto">
                                    <option value="">-- Seleccione el concepto del cargo--</option>
                                    <option>Cuota extraordinaria</option>
                                    <option>Sancion economica A</option>
                                    <option>Sancion economica B</option>
                                    <option>Sancion economica C</option>
                                    <option>Jardineria</option>
                                    <option>Pintura</option>
                                </select>
                                @error('concepto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Adjuntar comprobante</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('comprobante') is-invalid @enderror"
                                       id="comprobante" name="comprobante" aria-describedby="inputGroupFileAddon01"
                                       accept="image/*,application/pdf">
                                <label class="custom-file-label" for="inputGroupFile01">Elige el archivo con el
                                    comprobante</label>
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
        </div>
    </section>
@endsection

