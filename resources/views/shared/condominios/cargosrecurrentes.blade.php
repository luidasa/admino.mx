<div class="card">
    <div class="card-header">Cuotas recurrentes</div>
    <div class="card-body table-responsive">
        <table id="cargos" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Concepto</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Importe</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Periodicidad</th>
                <th scope="col">Fecha de término</th>
                <th scope="col">Estatus</th>
                <th scope="col">Modificar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cargos as $cargo)
                <tr>
                    <th scope="row">
                        <a href="{{ route('show-cargo-general', ['id' => $cargo->id]) }}">{{ $cargo->concepto }}</a>
                    </th>
                    <td>{{ $cargo->descripcion }}</td>
                    <td>{{ $cargo->importe }}</td>
                    <td>{{ date('d/m/Y', strtotime($cargo->fecha_inicio)) }}</td>
                    <td>{{ $cargo->periodicidad }}</td>
                    <td>{{ $cargo->fecha_fin !== null ? date('d/m/Y', strtotime($cargo->fecha_fin)) : 'permanente' }}</td>
                    <td>{{ $cargo->estatus }}</td>
                    <td>
                        @if ($cargo->estatus === 'creado')
                            <a href="{{ route('schedule-cargo-general', ['id' => $cargo->id]) }}"><i class="fas fa-calendar"></i></a>
                        @endif
                        @if ($cargo->estatus === 'planeado')
                            <a href="{{ route('unschedule-cargo-general', ['id' => $cargo->id]) }}"><i class="fas fa-calendar-times"></i></a>
                        @endif
                        @if ($cargo->estatus === 'creado')
                            <a href="{{ route('edit-cargo-general', ['id' => $cargo->id]) }}"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('delete-cargo-general', ['id' => $cargo->id]) }}"><i class="fas fa-trash"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <th><td colspan="7" class="text-right">
                {{ $cargos->links() }}
            </td></th>
            </tfoot>
        </table>
    </div>
    <div class="card-footer text-rigth">
        <a href="{{ route('create-cargo-general' ) }}" class="btn btn-primary">Registrar</a>
    </div>
</div>
