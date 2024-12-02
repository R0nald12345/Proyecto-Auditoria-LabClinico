@extends('adminlte::page')

@section('content_header')

@stop
@section('content')
    <form action="{{ route('analisis.hormonastore') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <input type="hidden" name="idAnalisis" value="{{ $analisis->id }}">
        <label for="validationCustom01">Nro de Analisis: {{ $analisis->id }}</label>
        <div class="form-row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Nro Orden</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                        value="{{ $idOrden }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Bioquímico</span>
                    </div>
                    <select class="custom-select" id="idbioquimico" name="idbioquimico" required>
                        @foreach ($bioquimico as $b)
                            <option value="{{$b->id}}">{{$b->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row mt-2">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Paciente"
                        aria-describedby="inputGroupPrepend" value="{{$nombrepaciente}}" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Fecha</span>
                    </div>
                    <input type="date" class="form-control" id="validationCustom04" placeholder="State"
                        value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
        </div>

        <label class="mt-2">Hormona</label>
        @foreach ($selectanalisis as $s)
            @if ($s->idOrden == $idOrden  && $s->analisistotal->tipo == 'Hormona')
                <div class="form-row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">{{ $s->analisistotal->nombre }}</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="{{ $s->analisistotal->nombre }}"
                                id="{{ $s->analisistotal->nombre }}" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
            @endif
        @endforeach



        <label class="mt-2">Resultado</label>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <textarea class="form-control"  name="resultado" id="resultado" placeholder=""></textarea>
                </div>
            </div>
        </div>


        <button class="btn btn-primary mt-2 mb-2" type="submit">Submit form</button>
    </form>
@endsection
