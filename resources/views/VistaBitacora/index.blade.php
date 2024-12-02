@extends('adminlte::page')
@section('title', 'Editar Tipo Seguro')

@section('content')
    <div
    class="bg-gradient-to-r  bg-blue-500 shadow-lg shadow-blue-500/50 to-cyan-600 py-1 mb-4 rounded-lg dark:from-gray-700 text-black dark:text-gray-200">
    <div class="container mx-auto text-center">
        <!-- Título de la página -->
        Bitacora
        <!-- Puedes agregar más contenido aquí si lo deseas -->
    </div>
</div>
    <div class="my-4 mx-2">
        <div class="overflow-x-auto bg-white shadow-md rounded px-4 py-4 mt-4">


            <!-- Contenedor centrado para el Reporte de Bitácora -->
            <div id="report-container">
                <h1 class="text-lg font-semibold mb-2">Revise</h1>
            </div>



            <form action="{{ route('bitacora1.index') }}" method="POST">
                @csrf
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-1/2">
                        <label for="start_date" class="text-gray-600 font-semibold text-sm">Fecha de inicio:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $start_date }}"
                            class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="w-1/2">
                        <label for="end_date" class="text-gray-600 font-semibold text-sm">Fecha de fin:</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $end_date }}"
                            class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    </div>



                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>


            <!-- Tabla con estilos mejorados -->
            <div id="activities_table" class="activities-table">
                @include('VistaBitacora.activities_table')
            </div>
        </div>
    </div>
    @endsection
    <script>
        function filterByDate() {
            // Obtener las fechas de inicio y fin
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;

            // Obtener todas las filas de la tabla
            var rows = document.querySelectorAll(".activity-row");

            // Recorrer cada fila y mostrar u ocultar según las fechas
            rows.forEach(function (row) {
                var date = row.cells[3].innerText.split(" ")[0]; // Obtener la fecha de la celda

                // Comparar la fecha actual con las fechas seleccionadas
                if (date >= startDate && date <= endDate) {
                    row.style.display = ""; // Mostrar la fila si está en el rango de fechas
                } else {
                    row.style.display = "none"; // Ocultar la fila si no está en el rango de fechas
                }
            });
        }


    </script>


<script>
    function imprimirBitacora() {
        var ventanaImpresion = window.open('', '_blank');
        var contenido = '<html><head><title>Reporte de Bitácora</title>';
        contenido += '<style>';
        contenido += 'body { font-family: Arial, sans-serif; }';
        contenido += '.logo { max-width: 200px; max-height: 100px; }';
        contenido += '.table-print { width: 100%; border-collapse: collapse; }';
        contenido += '.table-print th, .table-print td { border: 1px solid #000; padding: 8px; text-align: center; }';
        contenido += '</style>';
        contenido += '</head><body>';
        contenido += '<img src="file:///C:/xampp/htdocs/Libreria-Desarrollo-Cristiano/public/img/Loguito.png" alt="Logotipo de la empresa" class="logo" />';
        contenido += '<div id="report-container"><h1 class="text-2xl font-semibold mb-4">Reporte de Bitácora</h1></div>';
        contenido += '<table class="table-print">';
        contenido += '<thead><tr>';
        contenido += '<th>Id</th>';
        contenido += '<th>Nombre</th>';
        contenido += '<th>Actividad</th>';
        contenido += '<th>Fecha</th>';
        contenido += '</tr></thead>';
        contenido += '<tbody>';
        // Obtener las fechas de inicio y fin
        var startDate = document.getElementById("start_date").value;
        var endDate = document.getElementById("end_date").value;

        // Obtener todas las filas de la tabla
        var rows = document.querySelectorAll(".activity-row");

        // Recorrer cada fila y mostrar u ocultar según las fechas
        rows.forEach(function (row) {
            var date = row.cells[3].innerText.split(" ")[0]; // Obtener la fecha de la celda

            // Comparar la fecha actual con las fechas seleccionadas
            if (date >= startDate && date <= endDate) {
                contenido += '<tr>';
                var cells = row.querySelectorAll('td');
                cells.forEach(function(cell) {
                    contenido += '<td>' + cell.innerText + '</td>';
                });
                contenido += '</tr>';
            }
        });
        contenido += '</tbody></table>';
        contenido += '</body></html>';
        ventanaImpresion.document.write(contenido);
        ventanaImpresion.document.close();
        ventanaImpresion.print();
    }
</script>


