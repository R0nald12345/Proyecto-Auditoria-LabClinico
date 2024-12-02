@extends('adminlte::page')

@section('content_header')

@stop
@section('content')
    <label class="mt-2 text-center">Hormonas</label>

    <div class="form-row">
        <div class="col-md-4">
            <div class="mt-2"><strong>Nro Orden:</strong> {{ $hormona->analisis->orden->nroOrden }}</div>
        </div>
        <div class="col-md-4">
            <div class="mt-2"><strong>Paciente:</strong> {{ $hormona->analisis->orden->paciente->nombre }}</div>
        </div>
        <div class="col-md-4">
            @php
                // Calcular la edad a partir de la fecha de nacimiento
                $fechaNacimiento = \Carbon\Carbon::parse($hormona->analisis->orden->paciente->fechaNacimiento);
                $edad = $fechaNacimiento->age;
            @endphp
            <div class="mt-2"><strong>Edad:</strong> {{ $edad }} años</div>
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="mt-2"><strong>Bioquimico:</strong> {{ $hormona->analisis->bioquimico->nombre }}</div>
        </div>
        <div class="col-md-4">
            <div class="mt-2"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($hormona->created_at)->format('d/m/Y') }}
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="mt-1 text-primary"><strong>Datos</strong></div>
        </div>
        <div class="col-md-6">
            <div class="mt-2 text-primary"><strong>Valores de Referencia</strong></div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class=""><strong>TSH: </strong> {{ $hormona->TSH }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango: </strong>0.42 - 5.45 uUI/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>T3: </strong> {{ $hormona->T3 }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango: </strong>0.52 - 1.98 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>T4: </strong> {{ $hormona->T4 }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango: </strong>M 4.7 - 11.9 / H 4.3 - 10.7 ug/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>TSH Neonatal:</strong> {{ $hormona->TSHNeonatal }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0.7 - 15.2 uUI/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>T4 Libre:</strong> {{ $hormona->T4Libre }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0.7 - 1.9 ng/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Progesterona:</strong> {{ $hormona->progesterona }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0.2 - 1.5 ng/ml (fase folicular), 1.7 - 27.0 ng/ml (fase lútea)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Prolactina:</strong> {{ $hormona->prolactina }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>4.8 - 23.3 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Estradiol:</strong> {{ $hormona->estradiol }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>15 - 350 pg/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Cortisol 8am:</strong> {{ $hormona->cortisol8am }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>5 - 25 ug/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Cortisol 16pm:</strong> {{ $hormona->cortisol16pm }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>2 - 9 ug/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>LH:</strong> {{ $hormona->LH }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>1.9 - 12.5 mUI/ml (fase folicular), 0.5 - 16.9 mUI/ml (fase lútea)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>FSH:</strong> {{ $hormona->FSH }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>3.5 - 12.5 mUI/ml (fase folicular), 1.7 - 7.7 mUI/ml (fase lútea)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Testosterona:</strong> {{ $hormona->testosterona }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>2.5 - 9.5 ng/ml (hombres), 0.2 - 0.6 ng/ml (mujeres)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Testosterona Total:</strong> {{ $hormona->testosteronaTotal }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>300 - 1000 ng/dl (hombres), 20 - 80 ng/dl (mujeres)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Testosterona Libre:</strong> {{ $hormona->testosteronaLibre }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>5 - 15 pg/ml (hombres), 0.3 - 1.9 pg/ml (mujeres)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>H de Crecimiento:</strong> {{ $hormona->HDeCrecimiento }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0.06 - 5.0 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>H de Crecimiento Post Ejercicio:</strong> {{ $hormona->HDeCrecimientoPostEjercicio }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>5 - 10 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Insulina:</strong> {{ $hormona->insulina }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>2 - 25 uU/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Ac Anti TPO:</strong> {{ $hormona->AcAntiTP0 }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0 - 34 UI/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>DHEA:</strong> {{ $hormona->DHEA }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>1.3 - 7.8 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>DHEAS:</strong> {{ $hormona->DHEAS }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>80 - 560 ug/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>TPH:</strong> {{ $hormona->TPH }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>45 - 100 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>OHP PRG:</strong> {{ $hormona->OHPPRG }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0.1 - 0.8 ng/ml (hombres y mujeres)</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Anti CCP:</strong> {{ $hormona->antiCCP }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0 - 20 U/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Gastrina:</strong> {{ $hormona->gastrina }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0 - 100 pg/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Aldosterona:</strong> {{ $hormona->aldosterona }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>4 - 31 ng/dl</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>H Paratiroidea:</strong> {{ $hormona->HParatiroidea }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>10 - 65 pg/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Ant Antitiroglobulina TG:</strong> {{ $hormona->antAntitiroglobulinaTG }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>0 - 115 UI/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Ac Vanil Mandelico:</strong> {{ $hormona->acVanilMandelico }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>1.8 - 7.5 mg/24h</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>IGF I Somatomedina:</strong> {{ $hormona->IGFISomatomedina }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>109 - 284 ng/ml</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>IGFBP3:</strong> {{ $hormona->IGFBP3 }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>3.5 - 7.0 mg/l</div>
        </div>

        <div class="col-md-6">
            <div class=""><strong>Insulina Post Pand:</strong> {{ $hormona->insulinaPostPand }}</div>
        </div>
        <div class="col-md-6">
            <div class=""><strong>Rango:</strong>5 - 25 uU/ml</div>
        </div>
    </div>


@endsection
