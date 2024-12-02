@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">PACIENTES</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <p><strong>Carnet de Identidad:</strong> {{ $paciente->ci }}</p>
            <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fechaNacimiento }}</p>
            <p><strong>Sexo:</strong> {{ $paciente->sexo }}</p>
            <p><strong>Telefono:</strong> {{ $paciente->telefono }}</p>
            <p><strong>Correo Electronico:</strong> {{ $paciente->user->email }}</p>
            <p><strong>Tipo de Seguro:</strong> {{ $paciente->tipoSeguro->descripcion ?? 'Sin seguro' }}</p>
        </div>
    </div>

    <div class="form-group mt-2">
        <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Cancelar</a>
    </div>

@stop