<?php

namespace App\Http\Controllers;

use App\Models\TipoAnalisis;
use Illuminate\Http\Request;
use App\Models\Event;
class TipoAnalisisController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Id',
            'Nombre',
            'Descripcion',
            'Precio',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $tipoanalisis = TipoAnalisis::all();
        return view('VistaTiposAnalisis.index', compact('tipoanalisis', 'heads'));
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        // Crear una nueva instancia del modelo TipoSeguro
        $tipoanalisis = new  TipoAnalisis();

        // Asignar los valores del formulario a las propiedades del modelo
        $tipoanalisis->nombre = $request->nombre;
        $tipoanalisis->descripcion = $request->descripcion;
        $tipoanalisis->precio = $request->precio;

        // Guardar el tipo de seguro en la base de datos
        $tipoanalisis->save();

        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('Registro un tipo analisis: ' . $tipoanalisis->nombre);
    session()->flash('success', 'Se registró exitosamente');


        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tipoanalisis.index')->with('success', '¡El tipo de seguro se ha registrado exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(TipoAnalisis $tipoAnalisis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoAnalisis $tipoanalisis)
    {
        return view('VistaTiposAnalisis.edit', compact('tipoanalisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoAnalisis $tipoanalisis)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        // Actualizar los datos del tipo de seguro
        $tipoanalisis->nombre = $request->nombre;
        $tipoanalisis->descripcion = $request->descripcion;
        $tipoanalisis->precio = $request->precio;
        $tipoanalisis->save();

        // Redirigir a la página de índice de tipos de seguro con un mensaje de éxito
        return redirect()->route('tipoanalisis.index')->with('success', 'Los datos del tipo de seguro han sido actualizados correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAnalisis $tipoanalisis)
    {
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('elimino un tipo analisis: ' . $tipoanalisis->nombre);
    session()->flash('success', 'Se registró exitosamente');
        $tipoanalisis->delete();
        return redirect()->route('tipoanalisis.index')->with('success', 'Eliminado correctamente');

    }
}
