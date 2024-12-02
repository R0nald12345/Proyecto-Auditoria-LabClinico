@extends('adminlte::page')

@section('content_header')
@php
  use App\Models\Paciente;
  $Tpaciente=Paciente::All();
@endphp
@stop
@section('content')
@if (!$paciente)

    <form action="{{ route('orden.update', $orden->id) }}" method="POST" class="needs-validation" novalidate>
        @method('PUT')
        @csrf
        <label for="validationCustom01">Analisis Clinico | Orden</label>
        <div class="form-row">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                </div>
                <select class="custom-select" id="pacientes" name="pacientes">
                    <option value="nada">Seleccione...</option>
                    @foreach ($Tpaciente as $pacientes)
                    <option value="{{$pacientes->id}}">{{$pacientes->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">CI</span>
                    </div>
                    <input type="number" class="form-control" placeholder="" name="ci" id="ci"
                        aria-describedby="inputGroupPrepend readonly">
                </div>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                        aria-describedby="inputGroupPrepend readonly">
                </div>
            </div>

        </div>
        <div class="form-row mt-2">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Sexo</span>
                    </div>
                    <select class="custom-select" id="sexo" name="sexo">
                        <option selected disabled>Seleccione...</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Correo</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="correo" id="correo"
                        aria-describedby="inputGroupPrepend readonly">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Celular</span>
                    </div>
                    <input type="number" class="form-control" placeholder="" name="celular" id="celular"
                        aria-describedby="inputGroupPrepend readonly">
                </div>
            </div>

        </div>

        <div class="form-row mt-2">

            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Fecha Nacimiento</span>
                    </div>
                    <input type="date" class="form-control" placeholder="" name="fechanacimiento" id="fechanacimiento"
                        aria-describedby="inputGroupPrepend readonly">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Tipo de Seguro</span>
                    </div>
                    <select class="custom-select" id="tiposeguro" name="tiposeguro">
                        <option selected disabled>Seleccione...</option>
                        @foreach ($seguros as $seguro)
                        <option value="{{$seguro->id}}">{{$seguro->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="form-row mt-2">
            <div class="col">
                <span>Tipo de Analisis</span>
                <div class="input-group">
                    <br>
                    <div>
                        @foreach ($tipoanalisis as $o)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $o->id }}"
                                    id="tipoAnalisis{{ $o->id }}" name="tipoAnalisisIds[]">
                                <label class="form-check-label" for="tipoAnalisis{{ $o->id }}">
                                    {{ $o->nombre }}

                                </label>
                                <label class="form-check-label" for="tipoAnalisis{{ $o->id }}">
                                    | Precio: {{ $o->precio }} bs.

                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-adminlte bg-white text-dark border mt-2" type="submit">Registrar</button>
    </form>
@else
<form action="{{ route('orden.update', $orden->id) }}" method="POST" class="needs-validation" novalidate>

    @method('PUT')
    @csrf
    <label for="validationCustom01">Analisis Clinico | Orden</label>
    <div class="form-row">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                </div>
                <select class="custom-select" id="pacientes" name="pacientes">
                    <option value="nada">Seleccione...</option>
                    @foreach ($Tpaciente as $pacientes)
                    <option value="{{$pacientes->id}}">{{$pacientes->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">CI</span>
                </div>
                <input type="number" class="form-control" placeholder="" name="ci" id="ci"
                    aria-describedby="inputGroupPrepend readonly" value="{{ $paciente->ci }}">
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $user->name }}">
            </div>
        </div>

    </div>
    <div class="form-row mt-2">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Sexo</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $paciente->sexo }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Correo</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $paciente->correo }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Celular</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $paciente->telefono }}">
            </div>
        </div>

    </div>

    <div class="form-row mt-2">

        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Fecha Nacimiento</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $paciente->fechaNacimiento }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Tipo de Seguro</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="paciente" id="paciente"
                aria-describedby="inputGroupPrepend  readonly" value="{{ $seguropaciente->descripcion }}">
            </div>
        </div>

    </div>
    <div class="form-row mt-2">
        <div class="col">
            <span>Tipo de Analisis</span>
            <div class="input-group">
                <br>
                <div>
                    @foreach ($tipoanalisis as $o)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $o->id }}"
                                id="tipoAnalisis{{ $o->id }}" name="tipoAnalisisIds[]">
                            <label class="form-check-label" for="tipoAnalisis{{ $o->id }}">
                                {{ $o->nombre }}

                            </label>
                            <label class="form-check-label" for="tipoAnalisis{{ $o->id }}">
                                | Precio: {{ $o->precio }} bs.

                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-adminlte bg-white text-dark border mt-2" type="submit">Registrar</button>
</form>
@endif
@endsection
