@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Orden</h1>
@stop



@section('content')



    {{-- modal --}}
    <div class="form-group align-items-end">
        {{-- ---Custom modal-- --}}
        {{-- <x-adminlte-button label="Registrar" class="bg-white" title="Registrar" data-toggle="modal"
            data-target="#modalpromocion" /> --}}
            <a href="{{ route('orden.create') }}" class="btn btn-adminlte bg-white text-dark border mb-1" title="Registrar">Registrar</a>
            @can('users.index')
            <form action="{{ route('orden1.index') }}" method="POST">
                @csrf
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-1/4">
                        <label for="start_date" class="text-gray-600 font-semibold text-sm">Fecha de inicio:</label>
                        <input type="date" id="start_date" name="start_date" class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="w-1/4">
                        <label for="end_date" class="text-gray-600 font-semibold text-sm">Fecha de fin:</label>
                        <input type="date" id="end_date" name="end_date" class="px-3 py-2 w-full border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="w-1/4">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                    </div>
                    <div class="w-1/4">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>


            </form>
@endcan
        <x-adminlte-modal id="modalpromocion" title="Registrar Orden" size="lg" theme="dark" v-centered static-backdrop
            scrollable>
            <form action="" method="POST">
                @method('POST')
                @csrf

                {{-- <div class="form-row"> --}}
                    {{-- <div class="col mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Ci</span>
                            </div>
                            <input type="number" class="form-control" placeholder="" name="fecha" id="fecha"
                                aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Nombre</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="fecha" id="fecha"
                            aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Celular</span>
                            </div>
                            <input type="number" class="form-control" placeholder="" name="fecha" id="fecha"
                                aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Tipo de Seguro</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="fecha" id="fecha"
                            aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Fecha Nacimiento</span>
                            </div>
                            <input type="date" class="form-control" placeholder="" name="fecha" id="fecha"
                                aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Sexo</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="fecha" id="fecha"
                            aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div> --}}
                <div class="form-row">
                    <div class="col">
                        <span>Tipo de Analisis</span>
                        <div class="input-group">
                            <br>
                            <div>
                                @foreach ($tipoanalisis as $o)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $o->id }}"
                                            id="tipoAnalisis{{ $o->id }}" name="tipoAnalisisIds[]">
                                        <label class="form-check-label" for="tipoAnalisis{{ $o->id }}">
                                            {{ $o->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Bioquimico</span>
                            </div>
                            <select name="idBioquimico" class="form-control" id="idBioquimico">
                                @foreach ($bioquimico as $o)
                                    <option value="{{ $o->id }}">{{ $o->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                            </div>
                            <select name="idPaciente" class="form-control" id="idPaciente">
                                @foreach ($paciente as $o)
                                    <option value="{{ $o->id }}">{{ $o->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
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
                @foreach ($orden as $o)
                    @php
                        $hemogramaExistente = App\Models\HemogramaCompleto::where('idAnalisis', $o->id)->exists();
                    @endphp
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->nroOrden }}</td>
                        <td>
                            <ul>
                                @foreach ($datosOrdenAnalisis as $ordenAnalisis)
                                @if ($ordenAnalisis->orden_id == $o->id)
                                    <div>
                                        {{ $ordenAnalisis->tipoAnalisis->nombre }}
                                    </div>
                                @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $o->created_at }}</td>

                        <td>{{ $o->Paciente->nombre}}</td>
                        <td>{{ $o->estado}}</td>

                        <td width="15px">
                            @can('users.index')
                            <div class="d-flex">
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR"
                                    data-toggle="modal" data-target="#modalCustom{{ $o->id }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </div>
                            @endcan
                            <a href="{{route('orden.edit', $o->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                        </td>

                        <x-adminlte-modal id="modalCustom{{ $o->id }}" title="Eliminar" size="sm"
                            theme="warning" icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                            <div style="height: 50px;">¿Está seguro de eliminar el seguro?</div>
                            <x-slot name="footerSlot">
                                <form action="{{ route('orden.destroy', $o->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-adminlte-button class="btn-flat" type="submit" label="Aceptar" theme="dark" />
                                </form>

                                <x-adminlte-button theme="light" label="Cancelar" data-dismiss="modal" />
                            </x-slot>
                        </x-adminlte-modal>

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
