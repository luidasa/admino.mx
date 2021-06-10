<div class="card">
    <div class="card-header">
        @isset($condominio) {{ $condominio->nombre }} @else 'Nuevo condominio' @endisset
    </div>
    <div class="card body">
        <div class="row">
            <div class="col">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Generales</a>
                    @isset($condominio)
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mesa directiva</a>
                    <a class="nav-link" id="v-pills-cargos-tab" data-toggle="pill" href="#v-pills-cargos" role="tab" aria-controls="v-pills-cargos" aria-selected="false">Cargos generales</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Noticias e información</a>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
