@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del Rol:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $role->name }}" required>
                </div>
                <div class="form-group">
                    <label for="permisos">Permisos:</label>
                    <div class="row">
                        @foreach($permisos as $permiso)
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" {{
                                            $role->permissions->contains($permiso->id) ? 'checked' : '' }}>
                                        {{ $permiso->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Botones para enviar o cancelar la edición -->
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
