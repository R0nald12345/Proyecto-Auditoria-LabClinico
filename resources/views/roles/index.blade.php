@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Roles de Usuario</h1>
@stop

@section('content')
{{-- modal --}}
<div class="form-group align-items-end">
    {{-- Botón para abrir el modal --}}
    <x-adminlte-button label="Registrar nuevo rol" class="bg-white" title="Registrar nuevo rol" data-toggle="modal"
        data-target="#modalCrearRol" />

    {{-- Modal para la creación de roles --}}
    <x-adminlte-modal id="modalCrearRol" title="Crear Nuevo Rol" size="lg" theme="dark" v-centered static-backdrop
        scrollable>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            {{-- Campo de entrada para el nombre del rol --}}
            <x-adminlte-input name="nombre" type="text" label="Nombre del Rol" placeholder="Ingrese el nombre del rol"
                required />

            {{-- Sección para seleccionar permisos --}}
            <div class="form-group">
                <label for="permisos">Permisos:</label>
                <div class="row">
                    {{-- Iteración sobre los permisos disponibles --}}
                    @foreach($permisos as $permiso)
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                {{-- Checkbox para cada permiso --}}
                                <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}">
                                {{ $permiso->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Botones para enviar o cancelar el formulario --}}
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-button class="float-left mt-3" type="submit" label="Crear Rol" theme="dark" />
                </div>
            </div>
        </form>
    </x-adminlte-modal>
</div>
{{-- modal --}}

<div class="card">
    <div class="card-body">

        <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="white" with-buttons>


            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td width="15px">
                    <div class="d-flex">

                        {{-- Botón para editar --}}
                        
                        <a href="{{ route('roles.edit', $role) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="EDITAR">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        {{-- Botón para eliminar --}}
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="ELIMINAR"
                            data-toggle="modal" data-target="#modalCustom{{ $role->id }}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                        {{-- Botón para mostrar los permisos --}}
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-xs btn-default text-info mx-1 shadow"
                            title="MOSTRAR PERMISOS">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                        {{-- Otros botones de acciones --}}
                        {{-- Añade aquí tus otros botones de acciones si los necesitas --}}
                    </div>
                </td>

                {{-- Modal de confirmación para eliminar --}}
                <x-adminlte-modal id="modalCustom{{ $role->id }}" title="Eliminar" size="sm" theme="warning"
                    icon="fa-solid fa-triangle-exclamation" v-centered static-backdrop scrollable>
                    <div style="height: 50px;">¿Está seguro de eliminar el rol?</div>
                    <x-slot name="footerSlot">
                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
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
<link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css')}}">
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

        @if (session('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        });
        @endif
    });

</script>
@stop