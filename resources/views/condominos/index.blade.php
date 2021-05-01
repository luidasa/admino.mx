@extends('layouts.master')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('titulo', 'Condominos registrados')

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Condominos</li>
  </ol>
</nav>
@endsection

@section('contenido')
<div class="card">
        <div class="card-header">Condominios registrados</div>
        <div class="card-body">
        <table id="condominos" class="table table-responsive">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Dueño</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Residente</th>
            <th scope="col">Figura</th>
            <th scope="col">Saldo</th>
            <th scope="col">Ocupada</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($condominos as $condomino)
            <tr>
            <th scope="row">
                <a href="{{ route('show-condomino', ['id' => $condomino->id]) }}">{{ $condomino->id }}</a></th>
            <td>{{ $condomino->duenio }}</td>
            <td>{{ $condomino->telefono }}</td>
            <td>{{ $condomino->email }}</td>
            <td>{{ $condomino->residente }}</td>
            <td>{{ $condomino->figura }}</td>
            <td>{{ $condomino->saldo }}</td>
            <td>{{ $condomino->desocupada ? 'Desocupadas' : '' }}</td>
            <td>
            <a class="btn btn-link" href="{{ route('edit-condomino', ['id' => $condomino->id]) }}"><i class="fas fa-edit"></i></a>
            <td>
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