@extends('layouts.master')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('titulo', 'Pagos no identificados')

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Pagos</li>
  </ol>
</nav>
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Pagos registrados</div>
        <div class="card-body">
        <table id="pagos" class="table table-responsive">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha registrado</th>
            <th scope="col">Importe</th>
            <th scope="col">Casa</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pagos as $pago)
            <tr>
            <th scope="row">
                <a href="{{ route('show-pago', ['id' => $condomino->id]) }}">{{ $pago->id }}</a>
            </th>
            <td>{{ $pago->fecha_registro }}</td>
            <td>{{ $pago->monto }}</td>
            <td>{{ $pago->casa }}</td>
            <td>
                <a class="btn btn-link" href="{{ route('confirm-pago', ['id' => $pago->id]) }}"><i class="fas fa-edit"></i></a>
            </td>
            </tr>
        @endforeach
        </tbody>
        </table>    
        </div>
</div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="/assets/js/condomino-index.js"></script>
@endsection