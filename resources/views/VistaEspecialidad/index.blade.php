@extends('adminlte::page')

@section('title', 'Especialidades') {{-- Dar nombre a la pagina --}}

@section('content_header')
    <h1 class="m-0 text-dark">ESPECIALIDADES</h1>
@stop

@section('content')

    <div class = "card">

        <div class = "card-body">

            <!-- Button Crear Especialidad -->
            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                data-target="#ModalCreateEspecialidad">
                Crear Especialidad
            </button>

            <!-- Modal Crear Especialidad -->
            <div class="modal fade" id="ModalCreateEspecialidad" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="ModalCreateEspecialidadLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCreateEspecialidadLabel">Añadir Especialidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('especialidad.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        autocomplete="off">
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div> --}}
                    </div>
                </div>
            </div>


            <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>

                @php
                    $id = 1;
                @endphp

                @foreach ($especialidades as $especialidad)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $especialidad->nombre }}</td>
                        <td>{{ $especialidad->descripcion }}</td>

                        <td width="15px">
                            <div class="d-flex"> {{-- esto es lo que hace que los datos esten uno al lado del otro --}}

                                {{-- btn Editar --}}
                                <a href="{{ route('especialidad.edit', $especialidad->id) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i></a>

                                {{-- btn eliminar  --}}
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"
                                    data-toggle="modal" data-target="#modalDelete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>

                                {{-- MODAL Eliminar --}}
                                <x-adminlte-modal id="modalDelete" title="Eliminar" size="sm" theme="dark"
                                    icon="fas fa-bell" v-centered static-backdrop scrollable>
                                    <div style="height:80px;">Esta seguro de Eliminar al {{ $especialidad->nombre }}</div>
                                    <x-slot name="footerSlot">
                                        <form action="{{ route('especialidad.destroy', $especialidad->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <x-adminlte-button class="btn-flat" type="submit" label="Aceptar"
                                                theme="success" />
                                        </form>
                                        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" />
                                    </x-slot>
                                </x-adminlte-modal>
                            </div>
                        </td>
                    </tr>
                    @php
                        $id++;
                    @endphp
                @endforeach

            </x-adminlte-datatable>
        </div>
    </div>
@endsection
