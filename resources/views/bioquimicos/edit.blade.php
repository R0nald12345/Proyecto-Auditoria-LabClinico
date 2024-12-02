@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Bioquimico</h1>
@stop

@section('content')
    <form method="POST" action="{{ route('bioquimicos.update', $Bioquimico->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="ci" label="cedula de identidad" type="text" placeholder="" label-class="text-black"
                    value="{{ $Bioquimico->ci }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="direccion" label="direccion" type="text" placeholder="" label-class="text-black"
                    value="{{ $Bioquimico->direccion }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="nombre" label="nombre" type="text" placeholder="" label-class="text-black"
                value="{{ $Bioquimico->nombre }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="fechaNacimiento" label="fecha Nacimiento" type="date" placeholder="" label-class="text-black"
                    value="{{ $Bioquimico->fechaNacimiento }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control">
                    <option value="">ELEGIR SEXO</option>
                    <option value="MASCULINO"
                        {{ $Bioquimico->sexo == 'MASCULINO' ? 'selected' : '' }}>MASCULINO
                    </option>
                    <option value="FEMENINO"
                        {{ $Bioquimico->sexo == 'FEMENINO' ? 'selected' : '' }}>FEMENINO
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="telefono" label="telefono" type="text" placeholder="" label-class="text-black"
                    value="{{ $Bioquimico->telefono }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="idEspecialidad">Especialidad</label>
                <select name="idEspecialidad" id="idEspecialidad" class="form-control" required>
                    @foreach ($Especialidad as $seguro)
                    <option value="{{$seguro->id}}">{{$seguro->descripcion}}</option>
                    @endforeach
                    <option value="{{$Bioquimico->idEspecialidad}}" selected>{{$Bioquimico->Especialidad->nombre}}</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mt-2">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success" />
                <a href="{{route('bioquimicos.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
@stop
