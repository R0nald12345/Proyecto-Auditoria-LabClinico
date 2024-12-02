@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="ci" label="cedula de identidad" type="text" placeholder="" label-class="text-black"
                    value="{{ $paciente->ci }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="nombre" label="nombre" type="text" placeholder="" label-class="text-black" 
                value="{{ $paciente->nombre }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="fechaNacimiento" label="fecha Nacimiento" type="date" placeholder="" label-class="text-black"
                    value="{{ $paciente->fechaNacimiento }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control">
                    <option value="">ELEGIR SEXO</option>
                    <option value="MASCULINO"
                        {{ $paciente->sexo == 'MASCULINO' ? 'selected' : '' }}>MASCULINO
                    </option>
                    <option value="FEMENINO"
                        {{ $paciente->sexo == 'FEMENINO' ? 'selected' : '' }}>FEMENINO
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="telefono" label="telefono" type="text" placeholder="" label-class="text-black"
                    value="{{ $paciente->telefono }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="idTipoSeguro">Tipo de Seguro</label>
                <select name="idTipoSeguro" id="idTipoSeguro" class="form-control" required>
                    @foreach ($seguros as $seguro)
                    <option value="{{$seguro->id}}">{{$seguro->descripcion}}</option>
                    @endforeach
                    <option value="{{$paciente->idTipoSeguro}}" selected>{{$paciente->tipoSeguro->descripcion}}</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mt-2">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success" />
                <a href="{{route('pacientes.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
@stop