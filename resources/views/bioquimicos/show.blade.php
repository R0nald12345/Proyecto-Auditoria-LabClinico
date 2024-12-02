@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">BIOQUIMICOS</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <p><strong>Carnet de Identidad:</strong> {{ $Bioquimico->ci }}</p>
        <p><strong>Dirección:</strong> {{ $Bioquimico->direccion }}</p>
        <p><strong>Nombre:</strong> {{ $Bioquimico->nombre }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $Bioquimico->fechaNacimiento }}</p>
        <p><strong>Sexo:</strong> {{ $Bioquimico->sexo }}</p>
        <p><strong>Teléfono:</strong> {{ $Bioquimico->telefono }}</p>
    </div>
</div>

<div class="card mt-3">
    <h5 class="card-title">Horarios Asignados</h5>

    <div class="card-body">
        @foreach ($horarios as $horario)
            <p>{{ $horario->dia }}: {{ $horario->horarioEntrada }} - {{ $horario->horarioSalida }}</p>
        @endforeach
    </div>
</div>


    <div class="form-group mt-2">
        <a href="{{ route('bioquimicos.edit', $Bioquimico) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('bioquimicos.index') }}" class="btn btn-danger">Cancelar</a>
    </div>

@stop
