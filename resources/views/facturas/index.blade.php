@extends('layouts.public')

@section('header')
    @parent
@endsection

@section('titulo', 'Estados de cuenta')

@section('encabezado')
    <header class="page-header page-header-dark">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title">Estados de Cuenta</h1>
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
    <li class="breadcrumb-item active">Estados de Cuenta</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
    <div class="container">
<div class="card">
    <div class="card-header">Estados de cuenta registrados</div>
    <div class="card-body table-responsive">
        <table id="pagos" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Casa</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de corte</th>
                <th scope="col">Fecha de vencimiento</th>
                <th scope="col">Saldo inicial</th>
                <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($facturas as $factura)
                <tr>
                <th scope="row">
                    <a href="{{ route('show-factura', ['id' => $factura->id]) }}" target="_blank">{{ $factura->id }}</a>
                </th>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_inicio )) }}</td>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_corte )) }}</td>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_vencimiento )) }}</td>
                <td>{{ $factura->saldo_anterior }}</td>
                <td>{{ $factura->saldo_actual }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-right">
                        {{ $facturas->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer text-rigth">
        <a href="{{ route('generate-facturas') }}" class="btn btn-primary">Generar</a>
    </div>
</div>
    </div>

@endsection

@section('scripts')
    @parent
@endsection
