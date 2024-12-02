@extends('adminlte::page')
@section('title', 'Editar Horario')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Editar Horario</div>
                <div class="card-body">
                    <form action="{{ route('horario.update', $horario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="dia">Día:</label>
                            <input type="text" class="form-control" id="dia" name="dia" value="{{ $horario->dia }}">
                        </div>
                        <div class="form-group">
                            <label for="horarioEntrada">Horario Entrada:</label>
                            <input type="time" class="form-control" id="horarioEntrada" name="horarioEntrada" value="{{ $horario->horarioEntrada }}">
                        </div>
                        <div class="form-group">
                            <label for="horarioSalida">Horario Salida:</label>
                            <input type="time" class="form-control" id="horarioSalida" name="horarioSalida" value="{{ $horario->horarioSalida }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('horario.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
