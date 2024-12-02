<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $heads = [
            'Id',
            'dia',
            'horarioEntrada',
            'horarioSalida',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $horario = Horario::all();
        return view('VistaHorario.index', compact('horario', 'heads'));
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
        // Validar los datos del formulario
        $request->validate([
            'dia' => 'required|string|max:255',
            'horarioEntrada' => 'required|date_format:H:i', // H:i para validar el formato de hora
            'horarioSalida' => 'required|date_format:H:i', // H:i para validar el formato de hora
        ]);


        // Crear una nueva instancia del modelo TipoSeguro
        $horario = new Horario();

        // Asignar los valores del formulario a las propiedades del modelo
        $horario->dia = $request->dia;
        $horario->horarioEntrada = $request->horarioEntrada;
        $horario->horarioSalida = $request->horarioSalida;

        // Guardar el tipo de seguro en la base de datos
        $horario->save();
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('Registro un horario: ' . $horario->id);
    session()->flash('success', 'Se registró exitosamente');
        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('horario.index')->with('success', '¡El tipo de horario se ha registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        return view('VistaHorario.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'dia' => 'required|string|max:255',
          /// H:i para validar el formato de hora
        ]);

        $horario = Horario::findOrFail($id);

        // Imprime el modelo antes de actualizar para verificar
        \Log::info('Horario antes de actualizar:', $horario->toArray());

        $horario->update($request->all());

        // Imprime el modelo después de actualizar para verificar
        \Log::info('Horario después de actualizar:', $horario->toArray());

        activity()
            ->causedBy(auth()->user())
            ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
            ->log('Actualizó un horario: ' . $horario->id);

        session()->flash('success', 'Los datos del horario han sido actualizados correctamente.');

        return redirect()->route('horario.index')->with('success', 'Los datos del horario han sido actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {

        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino un horario: ' . $horario->id);
    session()->flash('success', 'Se registró exitosamente');
        $horario->delete();
        return redirect()->route('horario.index')->with('success', 'Eliminado correctamente');
    }
}
