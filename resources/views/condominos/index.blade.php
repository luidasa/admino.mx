@extends('layouts.public')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('titulo', 'Condominos registrados')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Condominios registrados</h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Condominos</li>
  </ol>
</nav>
@endsection

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">Condominios registrados</div>
            <div class="card-body table-responsive">
                <table id="condominos" class="table table-striped">
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
                            <td>{{ $condomino->desocupada ? 'Desocupada' : '' }}</td>
                            <td>
                                <a class="btn btn-link" href="{{ route('edit-condomino', ['id' => $condomino->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-link" href="{{ route('pagos', ['condomino_id'=> $condomino->id]) }}">
                                    <i class="fas fa-comment-dollar"></i>
                                </a>
                                <a class="btn btn-link" href="{{ route('cargos', ['condomino_id'=> $condomino->id]) }}">
                                    <i class="fas fa-receipt"></i>
                                </a>
                                <a class="btn btn-link" href="{{ route('show-facturas',
                    ['condomino_id'=> $condomino->id]) }}"><i class="fas fa-file-invoice-dollar"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr><td colspan="9">{{ $condominos->links() }}</td></tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
