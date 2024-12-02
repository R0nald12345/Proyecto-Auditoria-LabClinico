@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DASHBOARD</h1>

    {{-- @vite('resources/css/app.css') --}}
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Contenido principal -->
                <div class="col-md-10">
                    <x-adminlte-card title="Gráfica de Ordenes" theme="purple" icon="fas fa-lg fa-fan" removable collapsible>
                        <canvas id="lineChart"></canvas>
                    </x-adminlte-card>
                </div>
                <!-- Formulario de selección de fecha -->
                <div class="col-md-2">
                    <form method="GET" action="{{ route('home') }}">
                        @csrf
                        <div class="form-group">
                            <label for="fecha">Seleccionar mes:</label>
                            <input type="month" class="form-control" id="fecha" name="fecha"
                                value="{{ $fechaSeleccionada }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <!-- Primer small-box (ADMINISTRADOR) -->
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>1</h3>
                            <p>ADMINISTRADORES</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-secret"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Segundo small-box (RECEPCIONISTAS)-->
                <div class="col-md-4">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $CantRecepcionistas }}</h3>
                            <p>RECEPCIONISTAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Tercer small-box (BIOQUÍMICOS)-->
                <div class="col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $CantBioquimicos }}</h3>
                            <p>BIOQUÍMICOS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Cuarto small-box (PACIENTES)-->
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $CantPacientes }}</h3>
                            <p>PACIENTES</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    {{-- ESTE COMANDO MUESTRA TODAS LAS FECHAS DE ESE MES --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var labels = {!! json_encode($ordenesPorFecha->keys()) !!};
        var data = {!! json_encode($ordenesPorFecha->values()) !!};

        // Crear un arreglo con todas las fechas del mes
        var firstDate = new Date(labels[0]);
        var lastDate = new Date(labels[labels.length - 1]);
        var allDates = [];
        var currentDate = new Date(firstDate);

        while (currentDate <= lastDate) {
            allDates.push(currentDate.toISOString().split('T')[0]);
            currentDate.setDate(currentDate.getDate() + 1);
        }

        var chartData = [];
        for (var i = 0; i < allDates.length; i++) {
            var index = labels.indexOf(allDates[i]);
            if (index !== -1) {
                chartData.push(data[index]);
            } else {
                chartData.push(0);
            }
        }

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: allDates,
                datasets: [{
                    label: 'Cantidad de órdenes',
                    data: chartData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script> --}}

    {{-- ESTE COMANDO MUESTRA SOLAMENTE LAS FECHAS DE ESE MES --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($ordenesPorFecha->keys()) !!},
                datasets: [{
                    label: 'Cantidad de órdenes',
                    data: {!! json_encode($ordenesPorFecha->values()) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>


@endsection
