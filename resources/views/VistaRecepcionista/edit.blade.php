@extends('adminlte::page')
@section('title', 'Editar Recepcionista')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">EDITAR RECEPCIONISTA</div>
                    <div class="card-body">
                        <form action="{{ route('recepcionistas.update', $recepcionista->id) }}" method="POST" onsubmit="return validarFormulario()">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ci">CI:</label>
                                <input type="text" class="form-control" id="ci" name="ci"
                                    value="{{ $recepcionista->ci }}">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off"
                                    value="{{ $recepcionista->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" autocomplete="off"
                                    value="{{ $recepcionista->fechaNacimiento }}">
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
                                <input type="text" class="form-control" id="telefono" name="telefono" autocomplete="off"
                                    value="{{ $recepcionista->telefono }}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    autocomplete="off" value="{{ $recepcionista->direccion }}">
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <a href="{{ route('recepcionistas.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection