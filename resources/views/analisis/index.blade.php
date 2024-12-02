@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Analisis</h1>
@stop



@section('content')



    {{-- modal --}}
    <div class="form-group align-items-end">
        {{-- ---Custom modal-- --}}
        {{-- <x-adminlte-button label="Registrar" class="bg-white mb-2" title="Registrar" data-toggle="modal"
            data-target="#modalpromocion" /> --}}
        <form action="{{ route('analisis.index') }}" method="GET">
            @csrf
            <div class="flex items-center space-x-2">
                <div>
                    <label for="start_date" class="text-gray-600 font-semibold text-sm">Fecha de inicio:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $start_date }}"
                        class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <label for="end_date" class="text-gray-600 font-semibold text-sm">Fecha de fin:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $end_date }}"
                        class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>

        </form>

        <x-adminlte-modal id="modalpromocion" title="Registrar" size="lg" theme="dark" v-centered static-backdrop
            scrollable>
            <form action="{{ route('analisis.store') }}" method="POST">
                @method('POST')
                @csrf
                <x-adminlte-input name="fecha" type="date" label="Fecha" />
                <x-adminlte-input name="idOrden" type="text" label="Nro Orden" />
                <x-adminlte-input name="idBioquimico" type="text" label="Bioquimico" />
                <x-adminlte-button class="float-left mt-3" type="submit" label="Aceptar" theme="dark" />
                <x-adminlte-button class="btn btn-primary float-right mt-3" theme="light" label="Cancelar"
                    data-dismiss="modal" />
                <x-slot name="footerSlot">
                </x-slot>
            </form>
        </x-adminlte-modal>
    </div>
    {{-- modal --}}


    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>
                @foreach ($analisis as $o)
                    @php
                        try {
                            $hemogramaExistente = App\Models\HemogramaCompleto::where('idAnalisis', $o->id)->exists();
                            $hormonaExistente = App\Models\Hormonas::where('idAnalisis', $o->id)->exists();
                            $quimicaExistente = App\Models\quimicas::where('idAnalisis', $o->id)->exists();
                            $orinaExistente = App\Models\orinas::where('idAnalisis', $o->id)->exists();
                        } catch (\Exception $e) {
                            // Manejar la excepción aquí, por ejemplo:
                            $hemogramaExistente = false;
                            $hormonaExistente = false;
                            $quimicaExistente = false;
                            $orinaExistente = false;
                        }
                    @endphp
                    <tr>
                        <td>{{ $o->orden->nroOrden }}</td>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->descripcion }}</td>
                        <td>{{ $o->orden->paciente->nombre }}</td>
                        <td>{{ $o->created_at->format('Y-m-d') }}</td>
                        {{-- <td>{{ $o->bioquimico->nombre }}</td> --}}
                        <td>{{ $o->estado }}</td>
                        {{-- <td>{{ $o->orden->tipoAnalisis->nombre }}</td> --}}

                        <td width="15px">

                            <div class="d-flex">

                                @if ($o->descripcion == 'Hemograma')
                                    @if (!$hemogramaExistente)
                                        <a href="{{ route('analisis.hemograma', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fa-plus"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('hemograma.show2', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endif
                                @if ($o->descripcion == 'Hormona')
                                    @if (!$hormonaExistente)
                                        <a href="{{ route('analisis.hormona', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fa-plus"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('hormona.show2', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endif

                                @if ($o->descripcion == 'Quimica')
                                    @if (!$quimicaExistente)
                                        <a href="{{ route('analisis.quimica', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fa-plus"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('quimica.show2', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endif

                                @if ($o->descripcion == 'Orina')
                                    @if (!$orinaExistente)
                                        <a href="{{ route('analisis.orina', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fa-plus"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('orina.show2', $o->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Registrar">
                                            <i class="fa fa-lg fa-fw fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endif
                                {{-- <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR"
                                    data-toggle="modal" data-target="#modalCustom{{ $o->id }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button> --}}
                            </div>
                        </td>

                        {{-- <x-adminlte-modal id="modalCustom{{ $o->id }}" title="Eliminar" size="sm"
                            theme="warning" icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                            <div style="height: 50px;">¿Está seguro de eliminar el seguro?</div>
                            <x-slot name="footerSlot">
                                <form action="{{ route('analisis.destroy', $o->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-adminlte-button class="btn-flat" type="submit" label="Aceptar" theme="dark" />
                                </form>

                                <x-adminlte-button theme="light" label="Cancelar" data-dismiss="modal" />
                            </x-slot>
                        </x-adminlte-modal> --}}

                    </tr>
                @endforeach

            </x-adminlte-datatable>

        </div>
    </div>
@stop

@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css') }}">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            // // Configuración de DataTables
            // $('#tuTabla').DataTable({
            //     "search": {
            //         "search": "1"
            //     }
            // });
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            @if (session('deleted'))
                Toast.fire({
                    icon: 'info',
                    title: '{{ session('deleted') }}'
                });
            @endif


        });
    </script>
@stop
