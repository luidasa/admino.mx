@extends('layouts.public')

@section('header')
    @parent
@endsection

@section('titulo', 'Cargos')

@section('encabezado')
    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Cuotas próximas a vencer</h1>
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
                    href="{{ route('edit-condomino', ['condominio_id' => session('condominio_id'), 'id' => $condomino->id ]) }}">{{ $condomino->interior }}</a>
            </li>
            <li class="breadcrumb-item active">Cargos</li>
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
                <div class="card-header">Cuotas próximas a vencer</div>
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
                        @forelse ($cargos as $cargo)
                            <tr>
                                <th scope="row">
                                    @if ($cargo->archivo)
                                        <a href="{{ route('show-cargo', ['id' => $cargo->id]) }}" target="_blank"><i
                                                class="fas fa-paperclip"></i></a>
                                    @endif
                                </th>
                                <td>{{ date('d/m/Y', strtotime($cargo->fecha_vencimiento )) }}</td>
                                <td>{{ $cargo->importe }}</td>
                                <td>{{ $cargo->concepto }}</td>
                                <td>{{ $cargo->estatus }}</td>
                                <td>
                                    @if ($cargo->factura_id === null )
                                        <a href="{{ route('edit-cargo', ['id' => $cargo->id]) }}"><i
                                                class="fas fa-edit"></i></a>
                                    @else
                                        <a href="{{ route('show-factura', ['id' => $cargo->factura_id] ) }}"> {{ date('d/m/Y', strtotime($cargo->factura->fecha_corte)) }} </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No hay cargos proximos a vencer</td></tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $cargos->links() }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('create-cargo', ['condominio_id' => session('condominio_id'), 'condomino_id' => $condomino->id] ) }}"
                                   class="btn btn-primary">Registrar
                                </a>
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
