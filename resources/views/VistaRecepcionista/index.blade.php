@extends('adminlte::page')

@section('title', 'Especialidades') {{-- Dar nombre a la pagina --}}

@section('content_header')
    <h1 class="m-0 text-dark">RECEPCIONISTAS</h1>
@stop

@section('content')

    <div class = "card">

        <div class = "card-body">

            <!-- Button Crear Recepcionista -->
            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                data-target="#ModalCreateRecepcionista">
                Crear Recepcionista
            </button>

            <!-- Modal Crear Recepcionista -->
            <div class="modal fade" id="ModalCreateRecepcionista" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="ModalCreateRecepcionistaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCreateRecepcionistaLabel">Añadir Recepcionista</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('recepcionistas.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="ci">CI:</label>
                                    <input type="text" class="form-control" id="ci" name="ci"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="sexo">Sexo:</label>
                                    <select class="form-select" aria-label="Seleccionar" id="sexo" name="sexo">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
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

                @foreach ($recepcionistas as $recepcionista)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $recepcionista->ci }}</td>
                        <td>{{ $recepcionista->nombre }}</td>
                        <td>{{ $recepcionista->fechaNacimiento }}</td>
                        <td>{{ $recepcionista->sexo }}</td>
                        <td>{{ $recepcionista->telefono }}</td>
                        <td>{{ $recepcionista->direccion }}</td>

                        <td width="15px">
                            <div class="d-flex"> {{-- esto es lo que hace que los datos esten uno al lado del otro --}}

                                {{-- btn Editar --}}
                                <a href="{{ route('recepcionistas.edit', $recepcionista->id) }}"
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
                                    <div style="height:80px;">¿Esta seguro de Eliminar?</div>
                                    <x-slot name="footerSlot">
                                        <form action="{{ route('recepcionistas.destroy', $recepcionista->id) }}"
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
