@extends('layouts.public')

@section('header')
    @parent
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('titulo', 'Condominos registrados')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cuenta</h1>
</div>
@endsection

@section('camino')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
    <li class="breadcrumb-item active">{{ Auth::user()->name }}</li>
  </ol>
</nav>
@endsection

@section('contenido')

    <div class="container mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ml-0" href="{{ route('profile') }}">Cuenta</a>
            <a class="nav-link" href="{{ route('account-pagos') }}">Pagos</a>
            <a class="nav-link" href="{{ route('account-seguridad') }}">Seguridad</a>
            <a class="nav-link" href="{{ route('account-notificaciones') }}">Notificaciones</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card">
                    <div class="card-header">Fotografia</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" src="https://source.unsplash.com/QAB-WJcbgJk/300x300" alt="">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG o PNG menor 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button class="btn btn-primary" type="button">Subir fotografia</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Detalles</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1" for="inputUsername">Username (como va a aparecer tu nombre a otros usuarios)</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                            </div>
                            <!-- Form Row-->
                            <div class="form-row">
                                <!-- Form Group (first name)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Nombres</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputLastName">Apellidos</label>
                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="form-row">
                                <!-- Form Group (organization name)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Organization name</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                </div>
                                <!-- Form Group (location)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputLocation">Location</label>
                                    <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                            </div>
                            <!-- Form Row-->
                            <div class="form-row">
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
