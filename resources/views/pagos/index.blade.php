@extends('layouts.public')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
@endsection

@section('titulo', 'Pagos realizados condomino')

@section('encabezado')

    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Pagos efectuados por el condomino</h1>
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
                    href="{{ route('condominos', ['condominio_id', session('condominio_id')]) }}">Condominos</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('edit-condomino', ['condominio_id', session('condominio_id'), 'id' => $condomino->id ]) }}">{{ $condomino->interior }}</a>
            </li>
            <li class="breadcrumb-item active">Pagos</li>
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
                <div class="card-header">Pagos registrados</div>
                <div class="card-body table-responsive">
                    <table id="pagos" class="table table-striped">
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
                        @forelse ($pagos as $pago)
                            <tr>
                                <th scope="row">
                                    @if ($pago->archivo)
                                        <a href="{{ route('show-pago', ['id' => $pago->id]) }}" target="_blank"><i
                                                class="fas fa-paperclip"></i></a>
                                    @endif
                                </th>
                                <td>{{ date('d/m/Y', strtotime($pago->pagado_el)) }}</td>
                                <td>{{ $pago->importe }}</td>
                                <td>{{ $pago->forma }}</td>
                                <td>{{ $pago->referencia }}</td>
                                <td>
                                    @if ($pago->factura_id === null )
                                        <a href="{{ route('edit-pago', ['id' => $pago->id]) }}"><i
                                                class="fas fa-edit"></i></a>
                                    @else
                                        <a href="{{ route('show-factura', ['id' => $pago->factura_id] ) }}"> {{ date('d/m/Y', strtotime($pago->factura->fecha_corte)) }} </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay pagos registrados</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $pagos->links() }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('create-pago', ['condominio_id', session('condominio_id'), 'condomino_id' => $condomino->id] ) }}"
                                   class="btn btn-primary">Registrar</a>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    @parent
@endsection
