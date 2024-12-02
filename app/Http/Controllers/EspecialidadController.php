<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Id',
            'Nombre',
            'Descripcion'
        ];
        $especialidades = Especialidad::all();
        return view('VistaEspecialidad.index', compact('heads','especialidades'));
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
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);

        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('creo una especialidad');
    session()->flash('success', 'Se registró exitosamente');
        Especialidad::create(request()->all());
        return redirect()->route('especialidad.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $especialidad = Especialidad::find($id);
        return view('VistaEspecialidad.edit', compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);

        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('actualizo una especialidad');
    session()->flash('success', 'Se registró exitosamente');
        $especialidad = Especialidad::findOrfail($id);
        $especialidad->update(request()->all());
        return redirect()->route('especialidad.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino una especialidad');
    session()->flash('success', 'Se registró exitosamente');
        $especialidad = Especialidad::findOrfail($id);
        $especialidad->delete();
        return redirect()->route('especialidad.index');
    }
}
