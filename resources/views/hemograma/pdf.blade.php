<div class="form-row">
    <h2 style="text-align: center;">Análisis Clínico</h2>
    <div class="col-md-4">
        <div style="margin-top: 0.5rem; display: flex; gap: 2rem;">
            <div class="text-primary"><strong>Nro Orden:</strong> {{ $hemograma->analisis->orden->nroOrden }}<strong >Paciente:</strong> {{ $hemograma->analisis->orden->paciente->nombre }}</div>
        </div>
        </div>
    </div>

    <div class="col-md-4">
        @php
            // Calcular la edad a partir de la fecha de nacimiento
            $fechaNacimiento = \Carbon\Carbon::parse($hemograma->analisis->orden->paciente->fechaNacimiento);
            $edad = $fechaNacimiento->age;
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
        <div class="mt-1 text-danger"><strong>Serie Roja</strong></div>
    </div>
    <div class="col-md-6">
        <div class="mt-2 text-danger"><strong>Valores de Referencia</strong></div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Globulos Rojos:</strong> {{ $hemograma->globulosRojos }}</div>
    </div>
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
        <div class=""><strong>Hematocrito:</strong> {{ $hemograma->hematocrito }}</div>
    </div>
    @if ($edad >= 50)
        <div class="col-md-6">
            <div class=""><strong>Hombre: </strong> 40 - 48% </div>
            <div class=""><strong>Mujer: </strong> 37 - 44% </div>
        </div>
    @endif
    @if ($edad >= 12 && $edad < 50)
        <div class="col-md-6">
            <div class=""><strong>Hombre: </strong> 36 - 46% </div>
            <div class=""><strong>Mujer: </strong> 35 - 46% </div>
        </div>
    @endif
    @if ($edad < 12)
        <div class="col-md-6">
            <div class=""><strong>Hombre: </strong> 35 - 45% </div>
            <div class=""><strong>Mujer: </strong> 35 - 45% </div>
        </div>
    @endif
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Vol. Corpus Medio:</strong> {{ $hemograma->VCM }}</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong>Fermotolitro: </strong>80-97</div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Hemog. Corpus Media:</strong> {{ $hemograma->HCM }}</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong>Picograma: </strong>26-33</div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Conc. Hemog. Corps Media:</strong> {{ $hemograma->CHCM }}</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong>de: </strong>33-35 gr/dl</div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>VSG:</strong> {{ $hemograma->VSG }} hora</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong></strong>mm</div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Recuento de plaquetas:</strong> {{ $hemograma->recuento }}</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong></strong>140.000 - 350.000 mm3</div>
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
        <div class=""><strong>Globulos Blancos:</strong> {{ $hemograma->globulosBlancos }}</div>
    </div>
    @if ($edad >= 50)
    <div class="col-md-6">
        <div class=""><strong></strong> 4,000 - 11,000/mm³</div>
    </div>
    @endif
    @if ($edad >= 18 && $edad < 50)
    <div class="col-md-6">
        <div class=""><strong></strong>5.000 - 10.000 mm3</div>
    </div>
    @endif
    @if ($edad < 18)
    <div class="col-md-6">
        <div class=""><strong></strong>4,500 - 13,500/mm³</div>
    </div>
    @endif


</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Segmentados:</strong> {{ $hemograma->segmentados }}</div>
    </div>
    <div class="col-md-6">
        @if ($edad >= 50)
            <div class=""><strong></strong>50 - 70%</div>
        @endif
        @if ($edad >= 18 && $edad < 50)
            <div class=""><strong></strong>55 - 65 %</div>
        @endif
        @if ($edad < 18)
            <div class=""><strong></strong>25 - 35%</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Linfocitos:</strong> {{ $hemograma->linfocitos }}</div>
    </div>
    <div class="col-md-6">
        <div class=""><strong></strong>25 - 35 %</div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class=""><strong>Eosinofilos:</strong> {{ $hemograma->eosinofilos }}</div>
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
        <div class=""><strong>Metodo :</strong>{{ $hemograma->metodo }}</div>
        <div class=""><strong>Resultado :</strong>{{ $hemograma->resultado }}</div>
    </div>
</div>
