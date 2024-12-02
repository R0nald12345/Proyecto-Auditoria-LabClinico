@extends('adminlte::page')

@section('title', 'Reportes de Pagos') {{-- Dar nombre a la pagina --}}

@section('content_header')
    <h1 class="m-0 text-dark">Reportes de Pagos</h1>
@stop

@section('content')
<div class="flex items-center space-x-2">
    <div>
        <label for="start_date" class="text-gray-600 font-semibold text-sm">Fecha de inicio:</label>
        <input type="date" id="start_date" name="start_date"
            class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        <label for="end_date" class="text-gray-600 font-semibold text-sm">Fecha de fin:</label>
        <input type="date" id="end_date" name="end_date"
            class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</div>

    <div class = "card mt-3">

        <div class = "card-body">

            <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>

                @php
                    $id = 1;
                @endphp

                @foreach ($notaventa as $n)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $n->orden->paciente->nombre }}</td>
                        <td>{{ $n->metodoPago }}</td>
                        <td>{{ $n->created_at->format('Y-m-d') }}</td>
                        <td>{{ $n->created_at->format('H:i') }}</td>
                        <td>{{ $n->precio }}</td>
                        <td>Realizado</td>
                    </tr>
                    @php
                        $id++;
                    @endphp
                @endforeach

            </x-adminlte-datatable>
        </div>
    </div>
@endsection
