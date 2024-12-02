@extends('adminlte::page')
@section('title', 'Editar Tipo Seguro')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Editar Tipo Seguro</div>
                <div class="card-body">
                    <form action="{{ route('tiposeguro.update', $tiposeguro->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $tiposeguro->descripcion }}">
                        </div>
                        <div class="form-group">
                            <label for="descuento">Descuento:</label>
                            <input type="number" class="form-control" id="descuento" name="descuento" value="{{ $tiposeguro->descuento }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('tiposeguro.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
