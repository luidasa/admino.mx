@extends('layouts.master')

@section('header')
    @parent
@endsection

@section('titulo', 'Estados de cuenta')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Estados de cuenta por vencer</h1>
</div>
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
                <th scope="col">Estatus</th>
                <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($facturas as $factura)
                <tr>
                <th scope="row">
                    @if ($factura->archivo)
                    <a href="{{ route('show-cargo', ['id' => $cargo->id]) }}" target="_blank">{{ $factura->condomino->interior }}</a>
                    @else
                    {{ $factura->condomino->interior }}
                    @endif
                </th>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_inicio )) }}</td>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_corte )) }}</td>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_vencimiento )) }}</td>
                <td>{{ $factura->saldo_anterior }}</td>
                <td>{{ $factura->saldo_actual }}</td>
                <td>{{ $factura->estatus }}</td>
                <td></td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <th><td colspan="6" class="text-right">
                {{ $facturas->links() }}
                </td></th>
            </tfoot>
        </table>    
    </div>
    <div class="card-footer text-rigth">
    <a href="{{ route('generate-facturas') }}" class="btn btn-primary">Generar</a>
    </div>
</div>
@endsection

@section('scripts')
    @parent
@endsection