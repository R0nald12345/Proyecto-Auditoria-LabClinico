<?php

namespace App\Http\Controllers;
use App\Models\Bioquimico;
use App\Models\Hormonas;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notificacion;

class HormonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Orden',
            'Id',
            'Bioquimico',
            'Paciente',
            'Fecha',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $hormonas = Hormonas::all();
        return view('hormona.index', compact('hormonas', 'heads'));
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
    public function show(Hormonas $hormona)
    {
        $bioquimico= Bioquimico::all();

        //! codigo jhoel
        $user = User::find(auth()->user()->id);
        if( $user->hasRole('Paciente') ){
            $notificacion = Notificacion::where('analisisId', $hormona->idAnalisis)->first();
            if($user->paciente->id == $notificacion->pacienteId){
                $notificacion->read = 1;
                $notificacion->save();
            }
        }
         //! codigo jhoel


        return view('hormona.show', compact('hormona','bioquimico'));
    }
    public function show2(string $id)
    {
        $heads = [
            'Orden',
            'Id',
            'Bioquimico',
            'Paciente',
            'Fecha',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $hormonas = Hormonas::where('idAnalisis', $id)->get();
        return view('hormona.index', compact('hormonas', 'heads','id'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hormonas $hormona)
    {
        $bioquimico= Bioquimico::all();
        return view('hormona.edit', compact('hormona','bioquimico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hormonas = Hormonas::findOrFail($id);

        // Actualizar los glóbulos rojos del hemograma
        $hormonas->update([
            'TSH' => $hormonas->TSH,
            'T3' => $hormonas->T3,
            'T4' => $hormonas->T4,
            'TSHNeonatal' => $hormonas->TSHNeonatal,
            'T4Libre' => $hormonas->T4Libre,
            'progesterona' => $hormonas->progesterona,
            'prolactina' => $hormonas->prolactina,
            'estradiol' => $hormonas->estradiol,
            'cortisol8am' => $hormonas->cortisol8am,
            'cortisol16pm' => $hormonas->cortisol16pm,
            'LH' => $hormonas->LH,
            'FSH' => $hormonas->FSH,
            'testosterona' => $hormonas->testosterona,
            'testosteronaTotal' => $hormonas->testosteronaTotal,
            'testosteronaLibre' => $hormonas->testosteronaLibre,
            'HDeCrecimiento' => $hormonas->HDeCrecimiento,
            'HDeCrecimientoPostEjercicio' => $hormonas->HDeCrecimientoPostEjercicio,
            'insulina' => $hormonas->insulina,
            'AcAntiTP0' => $hormonas->AcAntiTP0,
            'DHEA' => $hormonas->DHEA,
            'DHEAS' => $hormonas->DHEAS,
            'TPH' => $hormonas->TPH,
            'OHPPRG' => $hormonas->OHPPRG,
            'antiCCP' => $hormonas->antiCCP,
            'gastrina' => $hormonas->gastrina,
            'aldosterona' => $hormonas->aldosterona,
            'HParatiroidea' => $hormonas->HParatiroidea,
            'antAntitiroglobulinaTG' => $hormonas->antAntitiroglobulinaTG,
            'acVanilMandelico' => $hormonas->acVanilMandelico,
            'IGFISomatomedina' => $hormonas->IGFISomatomedina,
            'IGFBP3' => $hormonas->IGFBP3,
            'insulinaPostPand' => $hormonas->insulinaPostPand,
            'resultado' => $hormonas->resultado,
        ]);

        // Obtener el análisis asociado al hemograma
        $analisis = $hormonas->analisis;

        // Actualizar el bioquímico del análisis
        $analisis->update([
            'idBioquimico' => $request->idbioquimico
        ]);

        return redirect()->route('hormona.show2', ['id' => $id])->with('success', 'Los datos han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hormonas $hormonas)
    {
        //
    }
}
