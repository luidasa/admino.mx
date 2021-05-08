@extends('layouts.master')

@section('header')
    @parent
@endsection

@section('titulo', 'Cargos')

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('condominos') }}">Condominos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('edit-condomino', ['id' => $condomino->id ]) }}">{{ $condomino->interior }}</a></li>
    <li class="breadcrumb-item active">Cargos</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
    <div class="card-header">Pagos registrados</div>
    <div class="card-body table-responsive">
        <table id="pagos" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha de vencimiento</th>
                <th scope="col">Importe</th>
                <th scope="col">Concepto</th>
                <th scope="col">Estatus</th>
                <th scope="col">Corregir</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cargos as $cargo)
                <tr>
                <th scope="row">
                    @if ($cargo->archivo)
                    <a href="{{ route('show-cargo', ['id' => $cargo->id]) }}" target="_blank"><i class="fas fa-paperclip"></i></a>
                    @endif
                </th>
                <td>{{ date('d/m/Y', strtotime($cargo->fecha_vecnimiento)) }}</td>
                <td>{{ $cargo->importe }}</td>
                <td>{{ $cargo->concepto }}</td>
                <td>{{ $cargo->estatus }}</td>
                <td>
                @if ($cargo->factura_id === null )
                    <a href="{{ route('edit-cargo', ['id' => $cargo->id]) }}"><i class="fas fa-edit"></i></a>
                @endif
                </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <th><td colspan="6" class="text-right">
                {{ $cargos->links() }}
                </td></th>
            </tfoot>
        </table>    
    </div>
    <div class="card-footer text-rigth">
    <a href="{{ route('create-cargo', ['condomino_id' => $condomino->id] ) }}" class="btn btn-primary">Registrar</a>
    </div>
</div>
@endsection

@section('scripts')
    @parent
@endsection