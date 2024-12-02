<x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>

  
    @foreach ($activities as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->properties }}</td>

            <td> @if($a->causer)
                {{ $a->causer->name }}
            @else
                Usuario no disponible
            @endif</td>
            <td>{{ $a->description }}</td>
            <td>{{ $a->created_at }}</td>


    @endforeach

</x-adminlte-datatable>
{{-- <table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Id</th>
            <th class="py-2 px-4 border-b">IP</th>
            <th class="py-2 px-4 border-b">Nombre Usuario</th>
            <th class="py-2 px-4 border-b">Actividad</th>
            <th class="py-2 px-4 border-b">Fecha</th>
        </tr>
    </thead>
    <tbody>
        <!-- Se agrega la clase 'activity-row' a cada fila -->
        @foreach($activities as $activity)
            <tr class="activity-row">
                <td class="py-2 px-4 border-b text-center">{{ $activity->id }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $activity->properties }}</td>
                <td class="py-2 px-4 border-b text-center">
                    @if($activity->causer)
                        {{ $activity->causer->name }}
                    @else
                        Usuario no disponible
                    @endif
                </td>
                <td class="py-2 px-4 border-b text-center">{{ $activity->description }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $activity->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}
