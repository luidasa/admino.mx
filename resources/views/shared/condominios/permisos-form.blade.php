<div class="card">
    <div class="card-header">Administración de colaboradores</div>
    <div class="card-body">
        <div class="table-responsive mt-1">

            <table class="table table-striped">
                @forelse($condominio->colaboradores as $colaborador)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            @isset($colaborador->colaborador)
                                <img class="img-thumbnail rounded-circle"
                                     src="{{ $colaborador->colaborador->photo ? $colaborador->colaborador->photo : '/assets/img/avataaars.svg' }}"
                                     width="32" height="32">
                            @else
                                <img class="img-thumbnail rounded-circle"
                                     src="/assets/img/avataaars.svg"
                                     width="32" height="32">
                        @endisset
                        <td>
                            <strong>{{ $colaborador->colaborador ? $colaborador->colaborador->name : $colaborador->destinatario }}</strong>
                            <div class="f6 color-text-secondary">
                                {{$colaborador->estatus}}
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <select name="role" id="role" class="custom-select">
                                    <option {{$colaborador->role == 'Presidente' ? 'selected': ''}} value="Presidente">Presidente</option>
                                    <option {{$colaborador->role == 'Secretario' ? 'selected': ''}} value="Secretario">Secretario</option>
                                    <option {{$colaborador->role == 'Tesorero' ? 'selected': ''}}  value="Tesorero">Tesorero</option>
                                    <option {{$colaborador->role == 'Vocal' ? 'selected': ''}} value="Vocal">Vocal</option>
                                    <option {{$colaborador->role == 'Administrador' ? 'selected': ''}} value="Administrador">Administrador</option>
                                    <option {{$colaborador->role == 'Residente' ? 'selected': ''}} value="Residente">Residente</option>
                                    <option {{$colaborador->role == 'Condomino' ? 'selected': ''}} value="Condomino">Condomino</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="borrar" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No hay colaboradores en el condominio</td></tr>
                @endforelse
            </table>
        </div>

        <div class="clearfix">
            <div class="float-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#invitar-form-modal">
                    Invitar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="invitar-form-modal" tabindex="-1" aria-labelledby="invitar-form-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('invitar-colaborador', ['condominio_id' => session('condominio_id')]) }}"
                  method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Invitar a colaborar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="invitar-email">Escribe o selecciona el email del colaborador</label>
                        <input type="text" class="form-control" name="invitar-email" id="invitar-email">
                    </div>
                    <div class="form-group">
                        <label for="invitar-permisos">Selecciona el rol del colaborador</label>
                        <select name="invitar-permisos" id="invitar-permisos" class="custom-select">
                            <option value="Presidente">Presidente</option>
                            <option value="Secretario">Secretario</option>
                            <option value="Tesorero">Tesorero</option>
                            <option value="Vocal">Vocal</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Invitar</button>
                </div>
            </form>
        </div>
    </div>
</div>
