@extends('adminlte::page')

@section('title', 'Detalles del Rol')

@section('content_header')
<h1>Detalles del Rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><strong>{{ $role->name }}</strong></h5>
        <p class="card-text"><strong>ID:</strong> {{ $role->id }}</p>
        <p class="card-text"><strong>Guard:</strong> {{ $role->guard_name }}</p>
        <p class="card-text"><strong>Permisos asociados:</strong></p>
        <ul class="list-group">
            @forelse ($role->permissions as $permission)
            <li class="list-group-item">{{ $permission->name }}</li>
            @empty
            <li class="list-group-item">Este rol no tiene permisos asociados</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Botones para editar, eliminar y volver -->
<div class="row mt-3 mb-4">
    <div class="col-12">
        
        <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary float-left mr-2">Editar</a>
        <form id="deleteRoleForm" action="{{ route('roles.destroy', $role) }}" method="POST" class="float-left mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" id="deleteRoleBtn">Eliminar</button>
        </form>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary float-right">Volver</a>
    </div>
</div>



@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Función para mostrar el cuadro de confirmación de eliminación
    $('#deleteRoleForm').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará el rol y desvinculará los permisos asociados. Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar la solicitud de eliminación
                $(this).unbind('submit').submit(); // Envía el formulario después de confirmar
            }
        });
    });

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
    });

</script>
@stop
