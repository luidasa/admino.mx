@extends('layouts.master')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('titulo', 'Pagos')

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('condominos') }}">Condominos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('edit-condomino', ['id' => $condomino->id ]) }}">{{ $condomino->interior }}</a></li>
    <li class="breadcrumb-item active">Pagos</li>
  </ol>
</nav>
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')
<div class="card">
    <div class="card-header">Pagos registrados</div>
    <div class="card-body">
        <table id="pagos" class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha registrado</th>
                <th scope="col">Importe</th>
                <th scope="col">Forma</th>
                <th scope="col">Referencia</th>
                <th scope="col">Corregir</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($condomino->pagos as $pago)
                <tr>
                <th scope="row">
                    <a href="{{ route('show-pago', ['id' => $condomino->id]) }}">{{ $pago->id }}</a>
                </th>
                <td>{{ $pago->pagado_el }}</td>
                <td>{{ $pago->importe }}</td>
                <td>{{ $pago->forma }}</td>
                <td>{{ $pago->referencia }}</td>
                <td>
                @if ($condomino->factura_id === null )
                    <a href="{{ route('edit-pago', ['id' => $condomino->id]) }}"><i class="fas fa-edit"></i></a>
                @endif
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>    
    </div>
    <div class="card-footer text-rigth">
    <a href="{{ route('create-pago', ['condomino_id' => $condomino->id] ) }}" class="btn btn-primary">Registrar</a>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="/assets/js/condomino-index.js"></script>
@endsection