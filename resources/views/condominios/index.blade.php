@extends('layouts.public')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
@endsection

@section('titulo', 'Condominios donde tienes acceso')

@section('encabezado')
    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Condominios</h1>
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
            <li class="breadcrumb-item active">Condominios</li>
        </ol>
    </nav>
@endsection

@section('contenido')
    <section class="bg-light pb-3 pt-3">
        <div class="container">
            <div class="card">
                <div class="card-header">Condominios registrados</div>
                <div class="card-body table-responsive">
                    <table id="condominos" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Codigo postal</th>
                            <th scope="col">Condominos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($condominios as $condominio)
                            <tr>
                                <td scope="row">
                                    <a href="{{ route('edit-condominio', ['id' => $condominio->id]) }}">{{ $condominio->nombre }}</a>
                                </td>
                                <td>{{ $condominio->direccion }}</td>
                                <td>{{ $condominio->codigo_postal }}</td>
                                <td>
                                    <a href="{{ route('condominos', ['condominio_id' => $condominio->id ]) }}" class="btn btn-link">{{ $condominio->condominos()->count() }}</a>
                                </td>
                        @empty
                            <tr>
                                <td colspan="4">Aun no tienes condominios registrados</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{ $condominios->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="{{ route('create-condominio') }}" class="btn btn-primary">Agregar</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
@endsection
