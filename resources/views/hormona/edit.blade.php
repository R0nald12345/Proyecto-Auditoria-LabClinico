@extends('adminlte::page')

@section('content_header')

@stop
@section('content')
    <form action="{{ route('hormona.update', ['hormona' => $hormona->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="mt-2">Hormona</label>
        <div class="form-row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Nro Orden</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                        value="{{ $hormona->analisis->orden->nroOrden }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                        value="{{ $hormona->analisis->orden->paciente->nombre }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Bioquímico</span>
                    </div>
                    <select class="custom-select" id="idbioquimico" name="idbioquimico" required>
                        <option value="{{ $hormona->analisis->bioquimico->id }}">
                            {{ $hormona->analisis->bioquimico->nombre }}</option>
                        @foreach ($bioquimico as $b)
                            @if ($hormona->analisis->bioquimico->id != $b->id)
                                <option value="{{ $b->id }}">{{ $b->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
@endsection
