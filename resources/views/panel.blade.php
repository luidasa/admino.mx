@extends('layouts.public')

@section('titulo', 'Panel de control')

@section('encabezado')
    <header class="page-header page-header-light pb-1">
        <div class="page-header-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="page-header-title mb-3">Panel de control</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('camino')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Inicio</li>
        </ol>
    </nav>
@endsection

@section('contenido')
    <section class="bg-light pt-3 pb-3">
        <div class="container">
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ingresos
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Gastos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saldo</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Normalidad</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Ingresos, egresos y saldos</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <div class="chartjs-size-monitor">
                                    <canvas id="myAreaChart" width="400" height="400px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Ingresos por mes
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A list item
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A second list item
                                    <span class="badge badge-primary badge-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A third list item
                                    <span class="badge badge-primary badge-pill">1</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Egresos por mes
                        </div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Minutas y acuerdos
                        </div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"
            integrity="sha256-uVEHWRIr846/vAdLJeybWxjPNStREzOlqLMXjW/Saeo=" crossorigin="anonymous"></script>
    <script>

        const DATA_COUNT = 7;
        const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

        const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];

        for (var a = [], i = 0; i < 6; ++i) a[i] = i;

        // http://stackoverflow.com/questions/962802#962890

        const shuffle = (numeros, top) => {
            let arreglo = [];
            for (let i = 0; i < numeros; i++) {
                arreglo.push(Math.floor(Math.random() * (top + 1)))
            }
            return arreglo;
        }

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Egresos',
                    data: shuffle(7, 10),
                    borderColor: "rgb(159, 206, 245, 1)",
                    backgroundColor: "rgb(159, 206, 245, .5)",
                },
                {
                    label: 'Ingresos',
                    data: shuffle(7, 10),
                    borderColor: "rgb(244, 147, 178, 1)",
                    backgroundColor: "rgb(244, 147, 178, .5)",
                },
                {
                    label: 'Saldo',
                    data: shuffle(7, 10),
                    borderColor: "rgb(201, 159, 252, 1)",
                    backgroundColor: "rgb(201, 159, 252, .5)",
                },
                {
                    label: 'Atrasos',
                    data: shuffle(7, 10),
                    borderColor: "rgb(255, 220, 135, 1)",
                    backgroundColor: "rgb(255, 220, 135, .5)",
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Ingresos, Egresos, Deudas y Saldos'
                    }
                }
            },
        };

        var ctx = document.getElementById('myAreaChart');
        var myChart = new Chart(ctx, config);
    </script>
@endsection
