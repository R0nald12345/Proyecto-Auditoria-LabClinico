<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\Bioquimico;
use App\Models\HemogramaCompleto;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notificacion;
use Barryvdh\DomPDF\Facade\Pdf;


class HemogramaCompletoController extends Controller
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
        $hemograma = HemogramaCompleto::all();
        return view('hemograma.index', compact('hemograma', 'heads'));
    }

    // public function generatePDF($id)
    // {
    //     // Obtener el hemograma utilizando el ID
    //     $hemograma = HemogramaCompleto::findOrFail($id);
    //     $bioquimico = Bioquimico::all();
    //     $pdf = Pdf::loadView('hemograma.pdf', compact('hemograma', 'bioquimico'));
    //     return $pdf->stream();
    // }

    public function generatePDF($id)
    {
        $hemograma = HemogramaCompleto::findOrFail($id);
        $bioquimico = Bioquimico::all();
        $pdf = PDF::loadView('hemograma.pdf', compact('hemograma', 'bioquimico'));

        // Para mostrar el PDF en lugar de descargarlo automáticamente
        return $pdf->stream('hemograma_' . $id . '.pdf');
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


        // Crear un nuevo registro de hemograma completo
        $hemograma = new HemogramaCompleto();

        // Asignar los valores de los campos del formulario al modelo
        $hemograma->globulosRojos = $request->input('globulosRojos');

        // Guardar el nuevo registro en la base de datos
        $hemograma->save();

        activity()
            ->causedBy(auth()->user())
            ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
            ->log('Registro un hemograma con el nombre: ' . $hemograma->globulosRojos);
        session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('anlisis.index')->with('success', '¡Se ha registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HemogramaCompleto $hemograma)
    {
        //dd($hemograma);
        $bioquimico = Bioquimico::all();
        //! codigo jhoel
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('Paciente')) {
            $notificacion = Notificacion::where('analisisId', $hemograma->idAnalisis)->first();
            if ($user->paciente->id == $notificacion->pacienteId) {
                $notificacion->read = 1;
                $notificacion->save();
            }
        }
        //! codigo jhoel

        return view('hemograma.show', compact('hemograma', 'bioquimico'));
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
        $hemograma = HemogramaCompleto::where('idAnalisis', $id)->get();

        return view('hemograma.index', compact('hemograma', 'heads', 'id'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HemogramaCompleto $hemograma)
    {
        $bioquimico = Bioquimico::all();
        return view('hemograma.edit', compact('hemograma', 'bioquimico'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hemograma = HemogramaCompleto::findOrFail($id);

        // Actualizar los glóbulos rojos del hemograma
        $hemograma->update([
            'globulosRojos' => $request->globulosRojos,
            'hematocrito' => $request->hematocrito,
            'hemoglobina' => $request->hemoglobina,
            'VCM' => $request->VCM,
            'HCM' => $request->HCM,
            'CHCM' => $request->CHCM,
            'VSG' => $request->VSG,
            'plaquetas' => $request->plaquetas,
            'recuento' => $request->recuento,
            'globulosBlancos' => $request->globulosblanco,
            'promielocitos' => $request->promielocito,
            'mielocitos' => $request->mielocitos,
            'metamielocitos' => $request->metamielocitos,
            'cayados' => $request->cayados,
            'segmentados' => $request->segmentados,
            'linfocitos' => $request->linfocitos,
            'monocitos' => $request->monocitos,
            'eosinofilos' => $request->eosinofilos,
            'basofilos' => $request->basofilos,
            'blastos' => $request->blastos,
            'grupoSanguineo' => $request->grupoSanguineo,
            'factorRh' => $request->factorRh,
            'VDRL' => $request->VDRL,
            'baciloscopia' => $request->baciloscopia,
            'coproparasitologico' => $request->coproparasitologico,
            'metodo' => $request->metodo,
            'resultado' => $request->resultado
        ]);

        // Obtener el análisis asociado al hemograma
        $analisis = $hemograma->analisis;

        // Actualizar el bioquímico del análisis
        $analisis->update([
            'idBioquimico' => $request->idbioquimico
        ]);

        return redirect()->route('hemograma.show2', ['id' => $hemograma->idAnalisis])->with('success', 'Los datos han sido actualizados correctamente.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HemogramaCompleto $hemogramaCompleto)
    {
        //
    }
}
