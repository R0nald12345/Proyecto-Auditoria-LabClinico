@extends('adminlte::page')

@section('title', 'Registrar Nuevo Usuario')

@section('content_header')
<h1>Registrar Nuevo Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Rol:</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}" >{{ $role->name }}
                    </option>

                    @endforeach
                </select>
                @error('role')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            {{-- Campos extras dependiendo del rol seleccionado --}}
            <div id="extra-fields">
                {{-- Aquí se agregarán los campos extras --}}
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    // Función para mostrar campos extras dependiendo del rol seleccionado
        $('#role').change(function() {
            var role = $(this).val();
            $('#extra-fields').empty(); // Limpiar campos extras

            if (role === 'Admin') {
                // No se agregan campos extras para el rol de admin
            } else if (role === 'Paciente' || role === 'Bioquimico' || role === 'Recepcionista') {
                // Campos extras para paciente, bioquímico y recepcionista
                $('#extra-fields').append(`
                    <div class="form-group">
                        <label for="ci">CI:</label>
                        <input type="text" class="form-control" id="ci" name="ci" value="{{ old('ci') }}" required>
                        @error('ci')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                    </div>
                `);
                if (role === 'Paciente') {
                    $('#extra-fields').append(`
                        <div class="form-group">
                            <label for="idTipoSeguro">Tipo de Seguro:</label>
                            <select class="form-control" id="idTipoSeguro" name="idTipoSeguro" required>
                                @foreach($seguros as $seguro)
                                    <option value="{{ $seguro->id }}">{{ $seguro->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    `);
                } else {
                    $('#extra-fields').append(`
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                        </div>
                    `);
                }
            }
        });
</script>
@stop