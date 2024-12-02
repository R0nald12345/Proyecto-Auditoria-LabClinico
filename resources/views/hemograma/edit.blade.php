@extends('adminlte::page')

@section('content_header')

@stop
@section('content')
    <form action="{{ route('hemograma.update', $hemograma->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="mt-2">Hemograma</label>
        <div class="form-row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Nro Orden</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                        value="{{ $hemograma->analisis->orden->nroOrden}}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Paciente</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                        value="{{ $hemograma->analisis->orden->paciente->nombre}}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Bioquímico</span>
                    </div>
                    <select class="custom-select" id="idbioquimico" name="idbioquimico" required>
                        <option value="{{$hemograma->analisis->bioquimico->id}}">{{$hemograma->analisis->bioquimico->nombre}}</option>
                        @foreach ($bioquimico as $b)
                            @if ($hemograma->analisis->bioquimico->id!=$b->id)
                            <option value="{{$b->id}}">{{$b->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>



        <div class="form-row">
            <div class="col">
                <label class="mt-1 text-danger">Serie Roja</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Globulos Rojos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="globulosrojos" id="globulosrojos" aria-describedby="inputGroupPrepend" value="{{ $hemograma->globulosRojos }}">

                </div>
            </div>
            <div class="col">
                <label class="mt-1 text-primary">Serie Blanca</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Globulos Blancos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="globulosblanco" id="globulosblanco"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->globulosBlancos }}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Hematocrito</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="hematocrito" id="hematocrito"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->hematocrito}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Promielocitos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="promielocito" id="promielocito"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->promielocitos}}" >
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Hemoglobina</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="hemoglobina" id="hemoglobina"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->hemoglobina}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Mielocitos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="mielocito" id="mielocito"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->mielocitos}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">V.C.M</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="VCM" id="VCM"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->VCM}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Metamielocitos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="metamielocitos" id="metamielocitos"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->metamielocitos}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">H.C.M</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="HCM" id="HCM"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->HCM}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Cayados</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="cayados" id=cayados""
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->cayados}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">C.H.C.M</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="CHCM" id="CHCM"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->CHCM}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Segmentados</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="segmentados" id="segmentados"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->segmentados}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">VSG 1 a h</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="VSG" id="VSG"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->VSG}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Linfocitos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="linfocitos" id="linfocitos"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->linfocitos}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Plaquetas</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="plaquetas" id="plaquetas"
                        aria-describedby="inputGroupPrepend"  value="{{ $hemograma->plaquetas}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Monocitos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="monocitos" id="monocitos"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->monocitos}}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Recuento</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="recuento" id="recuento"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->recuento}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Eosinofilos</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="eosinofilos" id="eosinofilos"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->eosinofilos}}">
                </div>
            </div>
        </div>

        <div class="form-row mt-2">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Grupo Sanguineo</span>
                    </div>
                    <input type="text" class="form-control" name="gruposanguineo" id="gruposanguineo" placeholder=""
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->grupoSanguineo}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Factor Rh</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" name="factorrh" id="factorrh"
                        aria-describedby="inputGroupPrepend" value="{{ $hemograma->factorRh}}">
                </div>
            </div>
        </div>
        <div class="form-row mt-2">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">V.D.R.L.</span>
                    </div>
                    <input type="text" class="form-control"  name="VDRL" id="VDRL" placeholder="" aria-describedby="inputGroupPrepend"value="{{ $hemograma->VDRL}}">
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">BACILOSCOPIA</span>
                    </div>
                    <input type="text" class="form-control" placeholder=""  name="baciloscopia" id="baciloscopia" aria-describedby="inputGroupPrepend" value="{{ $hemograma->baciloscopia}}">
                </div>
            </div>
        </div>
    
        <label class="mt-2">DIAGNOSTICO DE LA ENFERMEDAD DE CHAGAS</label>
        <div class="form-row mt-1">

            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Resultado</span>
                    </div>
                    <input type="text" class="form-control" placeholder=""  name="resultado" id="resultado" aria-describedby="inputGroupPrepend" value="{{ $hemograma->resultado}}">
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-2 mb-2" type="submit">Submit form</button>
    </form>
@endsection
