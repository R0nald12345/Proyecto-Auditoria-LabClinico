@extends('adminlte::page')

@section('content_header')

@stop
@section('content')
    <div class="form-row">
        <div class="col-md-4">
            <div class="mt-2"><strong>Nro Orden:</strong> {{ $hemograma->analisis->orden->nroOrden }}</div>
        </div>
        <div class="col-md-4">
            <div class="mt-2"><strong>Paciente:</strong> {{ $hemograma->analisis->orden->paciente->nombre }}</div>
        </div>
        <div class="col-md-4">
            @php
                // Calcular la edad a partir de la fecha de nacimiento
                $fechaNacimiento = \Carbon\Carbon::parse($hemograma->analisis->orden->paciente->fechaNacimiento);
                $edad = $fechaNacimiento->age;
                $sexo = $hemograma->analisis->orden->paciente->sexo; // Obtiene el sexo del paciente

            @endphp
            <div class="mt-2"><strong>Edad:</strong> {{ $edad }} años</div>
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="mt-2"><strong>Bioquimico:</strong> {{ $hemograma->analisis->bioquimico->nombre }}</div>
        </div>
        <div class="col-md-4">
            <div class="mt-2"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($hemograma->created_at)->format('d/m/Y') }}
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <label class="mt-4">Hemograma Completo</label>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="mt-1 text-primary"><strong>Serie Roja</strong></div>
        </div>
        <div class="col-md-6">
            <div class="mt-2 text-primary"><strong>Valores de Referencia</strong></div>
        </div>
    </div>
    <div class="form-row">
        @if ($hemograma->globulosRojos >= 4.2 && $hemograma->globulosRojos <= 5.6)
            <div class="col-md-6">
                <div class="text-success"><strong>Globulos Rojos:</strong> {{ $hemograma->globulosRojos }}</div>
            </div>
        @else
            <div class="col-md-6">
                <div class="text-warning"><strong>Globulos Rojos:</strong> {{ $hemograma->globulosRojos }}</div>
            </div>
        @endif

        @if ($edad >= 50)
            <div class="col-md-6">
                <div class=""><strong>Hombre: </strong> 4.2 - 5.6 millones mm3</div>
                <div class=""><strong>Mujer: </strong> 4.1 - 5.6 millones mm3</div>
            </div>
        @endif
        @if ($edad >= 12 && $edad < 50)
            <div class="col-md-6">
                <div class=""><strong>Hombre: </strong> 4.5 - 5.5 millones mm3</div>
                <div class=""><strong>Mujer: </strong> 3.9 - 5.0 millones mm3</div>
            </div>
        @endif
        @if ($edad < 12)
            <div class="col-md-6">
                <div class=""><strong>Hombre: </strong> 4.0 - 5.5 millones mm3</div>
                <div class=""><strong>Mujer: </strong> 3.9 - 5.5 millones mm3</div>
            </div>
        @endif

    </div>
    <div class="form-row">
        <div class="col-md-6">
            @if ($edad >= 50)
                @if (($sexo == 'MASCULINO' && $hemograma->hematocrito >= 40 && $hemograma->hematocrito <= 48) ||
                     ($sexo == 'FEMENINO' && $hemograma->hematocrito >= 37 && $hemograma->hematocrito <= 44))
                    <div class="text-success"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @else
                    <div class="text-warning"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @endif
            @elseif ($edad >= 12 && $edad < 50)
                @if (($sexo == 'MASCULINO' && $hemograma->hematocrito >= 36 && $hemograma->hematocrito <= 46) ||
                     ($sexo == 'FEMENINO' && $hemograma->hematocrito >= 35 && $hemograma->hematocrito <= 46))
                    <div class="text-success"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @else
                    <div class="text-warning"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @endif
            @elseif ($edad < 12)
                @if ($hemograma->hematocrito >= 35 && $hemograma->hematocrito <= 45)
                    <div class="text-success"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @else
                    <div class="text-warning"><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
                @endif
            @endif
        </div>
        <div class="col-md-6">
            @if ($edad >= 50)
                <div class=""><strong>MASCULINO: </strong> 40 - 48% </div>
                <div class=""><strong>FEMENINO: </strong> 37 - 44% </div>
            @elseif ($edad >= 12 && $edad < 50)
                <div class=""><strong>MASCULINO: </strong> 36 - 46% </div>
                <div class=""><strong>FEMENINO: </strong> 35 - 46% </div>
            @elseif ($edad < 12)
                <div class=""><strong>MASCULINO: </strong> 35 - 45% </div>
                <div class=""><strong>FEMENINO: </strong> 35 - 45% </div>
            @endif
        </div>
    </div>


    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>Vol. Corpus Medio:</strong>
                <span id="VCM" class="{{ $hemograma->VCM >= 80 && $hemograma->VCM <= 97 ? 'text-success' : 'text-warning' }}">
                    {{ $hemograma->VCM }}
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Fermotolitro: </strong>80-97</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>Hemog. Corpus Media:</strong>
                <span id="HCM" class="{{ $hemograma->HCM >= 26 && $hemograma->HCM <= 33 ? 'text-success' : 'text-warning' }}">
                    {{ $hemograma->HCM }}
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Picograma: </strong>26-33</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>Conc. Hemog. Corps Media:</strong>
                <span id="CHCM" class="{{ $hemograma->CHCM >= 33 && $hemograma->CHCM <= 35 ? 'text-success' : 'text-warning' }}">
                    {{ $hemograma->CHCM }}
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>de: </strong>33-35 gr/dl</div>
        </div>
    </div>



    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>VSG:</strong>
                <span id="VSG" class="{{ $hemograma->VSG >= 0 && $hemograma->VSG <= 20 ? 'text-success' : 'text-warning' }}">
                    {{ $hemograma->VSG }} hora
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class=""><strong></strong>mm</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>Recuento de plaquetas:</strong>
                <span id="recuento" class="{{ $hemograma->recuento >= 140000 && $hemograma->recuento <= 350000 ? 'text-success' : 'text-warning' }}">
                    {{ $hemograma->recuento }} mm<sup>3</sup>
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class=""><strong></strong>140.000 - 350.000 mm<sup>3</sup></div>
        </div>
    </div>



    <div class="form-row">
        <div class="col-md-6">
            <div class="mt-1 text-primary"><strong>Serie Blanca</strong></div>
        </div>
        <div class="col-md-6">
            <div class="mt-2 text-danger"><strong></strong></div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            @if ($edad >= 50)
                @if ($hemograma->globulosBlancos >= 4000 && $hemograma->globulosBlancos <= 11000)
                    <div class="text-success"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @else
                    <div class="text-warning"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @endif
            @elseif ($edad >= 18 && $edad < 50)
                @if ($hemograma->globulosBlancos >= 5000 && $hemograma->globulosBlancos <= 10000)
                    <div class="text-success"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @else
                    <div class="text-warning"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @endif
            @elseif ($edad < 18)
                @if ($hemograma->globulosBlancos >= 4500 && $hemograma->globulosBlancos <= 13500)
                    <div class="text-success"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @else
                    <div class="text-warning"><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
                @endif
            @endif
        </div>
        <div class="col-md-6">
            @if ($edad >= 50)
                <div class=""><strong></strong> 4,000 - 11,000/mm³</div>
            @elseif ($edad >= 18 && $edad < 50)
                <div class=""><strong></strong>5.000 - 10.000 mm3</div>
            @elseif ($edad < 18)
                <div class=""><strong></strong>4,500 - 13,500/mm³</div>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            @if ($edad >= 50)
                @if ($hemograma->segmentados >= 50 && $hemograma->segmentados <= 70)
                    <div class="text-success"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @else
                    <div class="text-warning"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @endif
            @elseif ($edad >= 18 && $edad < 50)
                @if ($hemograma->segmentados >= 55 && $hemograma->segmentados <= 65)
                    <div class="text-success"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @else
                    <div class="text-warning"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @endif
            @elseif ($edad < 18)
                @if ($hemograma->segmentados >= 25 && $hemograma->segmentados <= 35)
                    <div class="text-success"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @else
                    <div class="text-warning"><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
                @endif
            @endif
        </div>
        <div class="col-md-6">
            @if ($edad >= 50)
                <div class=""><strong></strong>50 - 70%</div>
            @elseif ($edad >= 18 && $edad < 50)
                <div class=""><strong></strong>55 - 65 %</div>
            @elseif ($edad < 18)
                <div class=""><strong></strong>25 - 35%</div>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            @if ($hemograma->linfocitos >= 25 && $hemograma->linfocitos <= 35)
                <div class="text-success"><strong>Linfocitos:</strong> {{ $hemograma->linfocitos }}</div>
            @else
                <div class="text-warning"><strong>Linfocitos:</strong> {{ $hemograma->linfocitos }}</div>
            @endif
        </div>
        <div class="col-md-6">
            <div class=""><strong></strong>25 - 35 %</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            @if ($hemograma->eosinofilos >= 2 && $hemograma->eosinofilos <= 5)
                <div class="text-success"><strong>Eosinofilos:</strong> {{ $hemograma->eosinofilos }}</div>
            @else
                <div class="text-warning"><strong>Eosinofilos:</strong> {{ $hemograma->eosinofilos }}</div>
            @endif
        </div>
        <div class="col-md-6">
            <div class=""><strong></strong>2 - 5 %</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>Grupo Sanguineo:</strong> {{ $hemograma->grupoSanguineo }}</div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <div class=""><strong>Factor RH:</strong> {{ $hemograma->factorRh }}</div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <div class=""><strong>V.D.R.L. :</strong>{{ $hemograma->VDRL }}</div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <div class=""><strong>BACILOSCOPIA :</strong>{{ $hemograma->baciloscopia }}</div>
        </div>
    </div>
    <div class="form-row mt-2">
        <div class="col-md-12">
            <div class=""><strong>COPROPARASITOLOGICO</strong></div>
            <div class=""><strong></strong>{{ $hemograma->coproparasitologico }}</div>
        </div>
    </div>
    <div class="form-row mt-2 mb-3">
        <div class="col-md-12">
            <div class=""><strong>DIAGNOSTICO DE LA ENFERMEDAD DE CHAGAS</strong></div>
            <div class=""><strong>Resultado :</strong>{{ $hemograma->resultado }}</div>
        </div>
    </div>
@endsection
