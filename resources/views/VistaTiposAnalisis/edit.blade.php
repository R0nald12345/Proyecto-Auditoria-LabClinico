@extends('adminlte::page')
@section('title', 'Editar Tipo Analisis')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Editar Tipo Analisis</div>
                <div class="card-body">
                    <form action="{{ route('tipoanalisis.update', $tipoanalisis->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tipoanalisis->nombre }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $tipoanalisis->descripcion }}">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" class="form-control" id="precio" name="precio" value="{{ $tipoanalisis->precio }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('tipoanalisis.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
