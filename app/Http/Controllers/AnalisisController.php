<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\HemogramaCompleto;
use App\Models\Bioquimico;
use App\Models\Hormonas;
use App\Models\Orinas;
use App\Models\Quimicas;
use App\Models\Notificacion;
use App\Models\Orden;
use App\Models\TipoAnalisis;
use App\Models\Selectanalisis;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Select;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $heads = [
            'Orden',
            'Id',
            'Descripcion',
            'Paciente',
            'Fecha',
            'Estado',
            ['label' => 'Acciones', 'no-export' => true],
        ];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Apply date filter
            $analisis = Analisis::whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date)
                                ->get();
        } else {
            // Load all records if no date range is provided
            $analisis = Analisis::all();
        }

        $tipoanalisis = TipoAnalisis::all();
        return view('analisis.index', compact('analisis', 'tipoanalisis', 'heads', 'start_date', 'end_date',));
    }


    public function informe(Request $request)
    {
        $heads = [
            'Orden',
            'Id',
            'Descripcion',
            'Paciente',
            'Fecha',
            'Costo',
            ['label' => 'Estado', 'no-export' => true],
        ];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Apply date filter
            $analisis = Analisis::whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date)
                                ->get();
        } else {
            // Load all records if no date range is provided
            $analisis = Analisis::all();
        }

        $tipoanalisis = TipoAnalisis::all();
        return view('analisis.informe', compact('analisis', 'tipoanalisis', 'heads', 'start_date', 'end_date'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    //Hemogramas
    public function hemograma($id)
    {
        $analisis = Analisis::findOrFail($id);
        // Obtener datos relacionados
        $idOrden = $analisis->orden->id;
        $nombrepaciente = $analisis->orden->paciente->nombre;
        $bioquimico = Bioquimico::all();
        $selectanalisis = SelectAnalisis::all();
        return view('analisis.hemograma', compact('analisis', 'idOrden', 'bioquimico', 'nombrepaciente','selectanalisis'));
    }
    public function hemogramastore(Request $request)
    {
        $hemograma = new HemogramaCompleto();
        $hemograma->globulosRojos = $request->input('globulosRojos');
        $hemograma->hematocrito = $request->input('hematocrito');
        $hemograma->hemoglobina = $request->input('hemoglobina');
        $hemograma->VCM = $request->input('VCM');
        $hemograma->HCM = $request->input('HCM');
        $hemograma->CHCM = $request->input('CHCM');
        $hemograma->VSG = $request->input('VSG');
        $hemograma->plaquetas = $request->input('plaquetas');
        $hemograma->recuento = $request->input('recuento');
        $hemograma->globulosBlancos = $request->input('globulosBlancos');
        $hemograma->promielocitos = $request->input('promielocitos');
        $hemograma->mielocitos = $request->input('mielocitos');
        $hemograma->metamielocitos = $request->input('metamielocitos');
        $hemograma->cayados = $request->input('cayados');
        $hemograma->segmentados = $request->input('segmentados');
        $hemograma->linfocitos = $request->input('linfocitos');
        $hemograma->monocitos = $request->input('monocitos');
        $hemograma->eosinofilos = $request->input('eosinofilos');
        $hemograma->basofilos = $request->input('basofilos');
        $hemograma->grupoSanguineo = $request->input('grupoSanguineo');
        $hemograma->factorRh = $request->input('factorRh');
        $hemograma->VDRL = $request->input('VDRL');
        $hemograma->baciloscopia = $request->input('baciloscopia');
        $hemograma->coproparasitologico = $request->input('coproparasitologico');
        $hemograma->metodo = $request->input('metodo');
        $hemograma->resultado = $request->input('resultado');
        $hemograma->idAnalisis = $request->input('idAnalisis');
        $hemograma->save();
        $analisis = Analisis::find($request->input('idAnalisis'));
        $analisis->idBioquimico = $request->input('idbioquimico');
        $analisis->estado = 'Realizado';                             // -->>>> cambia el estado cuando el bioquimico realiza el analisis
        $analisis->save();

        // Después de guardar el análisis, verificar si todos los análisis de la orden están realizados
        $this->verificarEstadoOrden($analisis->idOrden);

        $this->crearNotificacion($analisis->orden->paciente->id, $analisis->id); // esta linea de codigo tengo que meter para crear la notificacion al paciente

        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('agrego un hemograma');
    session()->flash('success', 'Se registró exitosamente');

        return redirect()->route('analisis.index')->with('success', '¡Se ha registrado exitosamente!');
    }



    public function crearNotificacion($pacienteId, $analisisId)
    {
        $notificacion = new Notificacion();
        $notificacion->pacienteId = $pacienteId;
        $notificacion->read = false;
        $notificacion->analisisId = $analisisId;
        $notificacion->save();
    }



    public function hormona($id)
    {
        $analisis = Analisis::findOrFail($id);
        $idOrden = $analisis->orden->id;
        $nombrepaciente = $analisis->orden->paciente->nombre;

        $bioquimico = Bioquimico::all();
        $selectanalisis = SelectAnalisis::all();

        return view('analisis.hormona', compact('analisis', 'idOrden', 'bioquimico', 'nombrepaciente','selectanalisis'));
    }

    public function hormonastore(Request $request)
    {

        $hormonas = new Hormonas();
        $hormonas->TSH = $request->input('TSH');
        $hormonas->TSH = $request->input('TSH');
        $hormonas->T3 = $request->input('T3');
        $hormonas->T4 = $request->input('T4');
        $hormonas->TSHNeonatal = $request->input('TSHNeonatal');
        $hormonas->T4Libre = $request->input('T4Libre');
        $hormonas->progesterona = $request->input('progesterona');
        $hormonas->prolactina = $request->input('prolactina');
        $hormonas->estradiol = $request->input('estradiol');
        $hormonas->cortisol8am = $request->input('cortisol8am');
        $hormonas->cortisol16pm = $request->input('cortisol16pm');
        $hormonas->LH = $request->input('LH');
        $hormonas->FSH = $request->input('FSH');
        $hormonas->testosterona = $request->input('testosterona');
        $hormonas->testosteronaTotal = $request->input('testosteronaTotal');
        $hormonas->testosteronaLibre = $request->input('testosteronaLibre');
        $hormonas->HDeCrecimiento = $request->input('HDeCrecimiento');
        $hormonas->HDeCrecimientoPostEjercicio = $request->input('HDeCrecimientoPostEjercicio');
        $hormonas->insulina = $request->input('insulina');
        $hormonas->AcAntiTP0 = $request->input('AcAntiTP0');
        $hormonas->DHEA = $request->input('DHEA');
        $hormonas->DHEAS = $request->input('DHEAS');
        $hormonas->TPH = $request->input('TPH');
        $hormonas->OHPPRG = $request->input('OHPPRG');
        $hormonas->antiCCP = $request->input('antiCCP');
        $hormonas->gastrina = $request->input('gastrina');
        $hormonas->aldosterona = $request->input('aldosterona');
        $hormonas->HParatiroidea = $request->input('HParatiroidea');
        $hormonas->antAntitiroglobulinaTG = $request->input('antAntitiroglobulinaTG');
        $hormonas->acVanilMandelico = $request->input('acVanilMandelico');
        $hormonas->IGFISomatomedina = $request->input('IGFISomatomedina');
        $hormonas->IGFBP3 = $request->input('IGFBP3');
        $hormonas->insulinaPostPand = $request->input('insulinaPostPand');
        $hormonas->idAnalisis = $request->input('idAnalisis');
        $hormonas->resultado = $request->input('resultado');
        $hormonas->save();
        $analisis = Analisis::find($request->input('idAnalisis'));
        $analisis->estado = 'Realizado';
        $analisis->idBioquimico = $request->input('idbioquimico');
        $analisis->save();

        // Después de guardar el análisis, verificar si todos los análisis de la orden están realizados
        $this->verificarEstadoOrden($analisis->idOrden);

        $this->crearNotificacion($analisis->orden->paciente->id, $analisis->id);  // esta linea de codigo tengo que meter para crear la notificacion al paciente
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('agrego una hormona');
        session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('analisis.index')->with('success', '¡Se ha registrado exitosamente!');
    }


    ///Quimica Sanguinea

    public function quimica($id)
    {
        $analisis = Analisis::findOrFail($id);
        $idOrden = $analisis->orden->id;
        $nombrepaciente = $analisis->orden->paciente->nombre;
        // $nombrePaciente = $analisis->orden->paciente->nomwbre; // Asumiendo que tienes la relación definida
        // $nombreSeguro = $analisis->orden->paciente->tipoSeguro->descripcion; // Asumiendo que tienes la relación definida
        $bioquimico = Bioquimico::all();
        $selectanalisis = SelectAnalisis::all();

        return view('analisis.quimicasanguinea', compact('analisis', 'idOrden', 'bioquimico', 'nombrepaciente','selectanalisis'));
    }

    public function quimicastore(Request $request)
    {

        $quimica = new Quimicas();
        $quimica->glucosa = $request->input('glucosa');
        $quimica->urea = $request->input('urea');
        $quimica->creatinina = $request->input('creatinina');
        $quimica->acidoUrico = $request->input('acidoUrico');
        $quimica->colesterol = $request->input('colesterol');
        $quimica->trigliceridos = $request->input('trigliceridos');
        $quimica->colesterolHDL = $request->input('colesterolHDL');
        $quimica->colesterolLDL = $request->input('colesterolLDL');
        $quimica->colesterolVLDL = $request->input('colesterolVLDL');
        $quimica->lipidoTotales = $request->input('lipidoTotales');
        $quimica->fosfolipidos = $request->input('fosfolipidos');
        $quimica->proteinasTotales = $request->input('proteinasTotales');
        $quimica->albuminas = $request->input('albuminas');
        $quimica->globulina = $request->input('globulina');
        $quimica->cloro = $request->input('cloro');
        $quimica->sodio = $request->input('sodio');
        $quimica->potasio = $request->input('potasio');
        $quimica->calcio = $request->input('calcio');
        $quimica->calcioIonico = $request->input('calcioIonico');
        $quimica->troponina = $request->input('troponina');
        $quimica->ferritina = $request->input('ferritina');
        $quimica->transferrina = $request->input('transferrina');
        $quimica->fosforo = $request->input('fosforo');
        $quimica->hierro = $request->input('hierro');
        $quimica->litio = $request->input('litio');
        $quimica->magnesio = $request->input('magnesio');
        $quimica->amilasa = $request->input('amilasa');
        $quimica->lipasa = $request->input('lipasa');
        $quimica->transaminasaGOT = $request->input('transaminasaGOT');
        $quimica->transaminasaGPT = $request->input('transaminasaGPT');
        $quimica->fosfatasaAlcalina = $request->input('fosfatasaAlcalina');
        $quimica->fosfAcidaTotal = $request->input('fosfAcidaTotal');
        $quimica->fostAcidaProstatica = $request->input('fostAcidaProstatica');
        $quimica->creatinFosfoKinasaCPK = $request->input('creatinFosfoKinasaCPK');
        $quimica->deshidrogemasaLacticaLDH = $request->input('deshidrogemasaLacticaLDH');
        $quimica->idAnalisis = $request->input('idAnalisis');
        $quimica->save();

        $analisis = Analisis::find($request->input('idAnalisis'));
        $analisis->estado = 'Realizado';
        $analisis->idBioquimico = $request->input('idbioquimico');
        $analisis->save();

        // Después de guardar el análisis, verificar si todos los análisis de la orden están realizados
        $this->verificarEstadoOrden($analisis->idOrden);

        $this->crearNotificacion($analisis->orden->paciente->id, $analisis->id);  // esta linea de codigo tengo que meter para crear la notificacion al paciente
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('agrego un analisis de quimica');
        session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('analisis.index')->with('success', '¡Se ha registrado exitosamente!');
    }

///orinaaaa

public function orina($id)
{
    $analisis = Analisis::findOrFail($id);
    $idOrden = $analisis->orden->id;
    $nombrepaciente = $analisis->orden->paciente->nombre;
    $bioquimico = Bioquimico::all();
    $selectanalisis = SelectAnalisis::all();
    return view('analisis.orinacompleta', compact('analisis', 'idOrden', 'bioquimico', 'nombrepaciente','selectanalisis'));
}

public function orinastore(Request $request)
{

    $orina = new Orinas();
    $orina->volumen = $request->input('volumen');
    $orina->color = $request->input('color');
    $orina->aspecto = $request->input('aspecto');
    $orina->densidad = $request->input('densidad');
    $orina->ph = $request->input('ph');
    $orina->olor = $request->input('olor');
    $orina->proteinas = $request->input('proteinas');
    $orina->glucosa = $request->input('glucosa');
    $orina->cetonas = $request->input('cetonas');
    $orina->urobilinogeno = $request->input('urobilinogeno');
    $orina->hemoglobina = $request->input('hemoglobina');
    $orina->nitritos = $request->input('nitritos');
    $orina->bilirrubina = $request->input('bilirrubina');
    $orina->sangre = $request->input('sangre');
    $orina->celulasEpiteliales = $request->input('celulasEpiteliales');
    $orina->eritrocitos = $request->input('eritrocitos');
    $orina->leucocitos = $request->input('leucocitos');
    $orina->bacterias = $request->input('bacterias');
    $orina->filamentosDeMucus = $request->input('filamentosDeMucus');
    $orina->cristalesUratosAmorfes = $request->input('cristalesUratosAmorfes');
    $orina->cristalesOxalatoDeCalcio = $request->input('cristalesOxalatoDeCalcio');
    $orina->cristalesFosfatosAmorfos = $request->input('cristalesFosfatosAmorfos');
    $orina->cristalesDeAcidoUrico = $request->input('cristalesDeAcidoUrico');
    $orina->cilindrosHialino = $request->input('cilindrosHialino');
    $orina->cilindrosGranuloso = $request->input('cilindrosGranuloso');
    $orina->cilindrosLeucocitario = $request->input('cilindrosLeucocitario');
    $orina->levaduras = $request->input('levaduras');
    $orina->fosfTripleDeAmonioYMagnesio = $request->input('fosfTripleDeAmonioYMagnesio');
    $orina->idAnalisis = $request->input('idAnalisis');
    $orina->save();

    $analisis = Analisis::find($request->input('idAnalisis'));
    $analisis->estado = 'Realizado';
    $analisis->idBioquimico = $request->input('idbioquimico');
    $analisis->save();

    // Después de guardar el análisis, verificar si todos los análisis de la orden están realizados
    $this->verificarEstadoOrden($analisis->idOrden);

    $this->crearNotificacion($analisis->orden->paciente->id, $analisis->id);  // esta linea de codigo tengo que meter para crear la notificacion al paciente
    activity()
    ->causedBy(auth()->user())
    ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
    ->log('agrego un analisis de quimica');
    session()->flash('success', 'Se registró exitosamente');
    return redirect()->route('analisis.index')->with('success', '¡Se ha registrado exitosamente!');
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Analisis $analisis)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analisis $analisis)
    {
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino un analisis');
    session()->flash('success', 'Se registró exitosamente');
        $analisis->delete();
        return redirect()->route('analisis.index')->with('success', 'Eliminado correctamente');
    }


    private function verificarEstadoOrden($idOrden)
    {
        $orden = Orden::find($idOrden);
        if ($orden) {
            $todosRealizados = $orden->analisis()->where('estado', '!=', 'Realizado')->count() == 0;
            if ($todosRealizados) {
                $orden->estado = 'Finalizado';
                $orden->save();
            }
        }
    }
}
