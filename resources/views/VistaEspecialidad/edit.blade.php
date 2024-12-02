@extends('adminlte::page')
@section('title', 'Editar Especialidad')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">Editar Especialidad</div>
                    <div class="card-body">

                        <form action="{{ route('especialidad.update', $especialidad->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="{{ $especialidad->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    autocomplete="off" value="{{ $especialidad->descripcion }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="{{ route('especialidad.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


