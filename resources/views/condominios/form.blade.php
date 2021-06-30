@extends('layouts.public')

@section('titulo', 'Modificar los datos del condominio')

@section('encabezado')

    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">{{ !isset($condominio) ? 'Agregar condominio': $condominio->nombre }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('camino')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if(session('condominio_id'))
                <li class="breadcrumb-item"><a href="{{ route('panel', ['id' => session('condominio_id')]) }}">Panel</a>
                </li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Panel</a></li>
            @endif
            <li class="breadcrumb-item active">
                @isset($condominio)
                    {{$condominio->nombre}}
                @else
                    {{'Nuevo condominio'}}
                @endisset</li>
        </ol>
    </nav>
@endsection

@section('feedback')
    @parent
@endsection

@section('contenido')
    <section class="bg-light pb-3 pt-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('shared.alert');
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 px-2 pb-2">
                    @include('shared.condominios.form-menu')
                </div>
                <div class="col-md-9 px-2 pt-2">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            @include('shared.condominios.generales-form')
                        </div>

                        @isset($condominio)
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            @include('shared.condominios.permisos-form')
                        </div>
                        <div class="tab-pane fade" id="v-pills-cargos" role="tabpanel" aria-labelledby="v-pills-cargos-tab">
                            @include('shared.condominios.cargosrecurrentes');
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"> Aqui va el formulario para agregar las notificaciones para cada condomino</div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

