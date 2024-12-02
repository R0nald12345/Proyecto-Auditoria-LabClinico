<?php

namespace App\Http\Controllers;

use App\Models\TipoSeguro;
use Illuminate\Http\Request;

class TipoSeguroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Id',
            'Descripcion',
            'Descuento',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $tiposeguro = TipoSeguro::all();
        return view('VistaTipoSeguro.index', compact('tiposeguro', 'heads'));
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
            'descripcion' => 'required|string|max:255',
            'descuento' => 'required|numeric',
        ]);

        // Crear una nueva instancia del modelo TipoSeguro
        $tipoSeguro = new TipoSeguro();

        // Asignar los valores del formulario a las propiedades del modelo
        $tipoSeguro->descripcion = $request->descripcion;
        $tipoSeguro->descuento = $request->descuento;

        // Guardar el tipo de seguro en la base de datos
        $tipoSeguro->save();
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('Registro un tipo seguro: ' . $tipoSeguro->descripcion);
    session()->flash('success', 'Se registró exitosamente');
        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tiposeguro.index')->with('success', '¡El tipo de seguro se ha registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoSeguro $tipoSeguro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoSeguro $tiposeguro)
    {
        return view('VistaTipoSeguro.edit', compact('tiposeguro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        request()->validate([
            'descripcion' => 'required|string|max:255',
            'descuento' => 'required|numeric',
        ]);
        $tipoSeguro = TipoSeguro::findOrFail($id);
        $tipoSeguro->update($request->all());
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('actualizo un tipo seguro: ' . $tipoSeguro->descripcion);
    session()->flash('success', 'Se registró exitosamente');
        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tiposeguro.index')->with('success', 'Los datos del tipo de seguro han sido actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoSeguro $tiposeguro)
    {
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino un tipo seguro: ' . $tiposeguro->descripcion);
    session()->flash('success', 'Se registró exitosamente');
        $tiposeguro->delete();
        return redirect()->route('tiposeguro.index')->with('success', 'Eliminado correctamente');
    }
}
