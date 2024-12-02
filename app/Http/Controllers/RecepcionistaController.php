<?php

namespace App\Http\Controllers;

use App\Models\Recepcionista;
use Illuminate\Http\Request;
use App\Models\User;

class RecepcionistaController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = ['Id', 'CI', 'Nombre', 'Fecha de Nacimiento', 'Sexo', 'Teléfono', 'Dirección'];
        $recepcionistas = Recepcionista::all();
        return view('VistaRecepcionista.index', compact('heads', 'recepcionistas'));
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
            'ci' => 'required',
            'nombre' => 'required',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email',
            'direccion' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => $request->ci,
        ]);

        $recepcionista = new Recepcionista();
        $recepcionista->ci = $request->ci;
        $recepcionista->nombre = $request->nombre;
        $recepcionista->fechaNacimiento = $request->fechaNacimiento;
        $recepcionista->sexo = $request->sexo;
        $recepcionista->telefono = $request->telefono;
        $recepcionista->direccion = $request->direccion;
        $recepcionista->idUsuario = $user->id; 
        $recepcionista->save();
        return redirect()->route('recepcionistas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recepcionista $recepcionista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recepcionista = Recepcionista::find($id);
        return view('VistaRecepcionista.edit', compact('recepcionista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'ci' => 'required',
            'nombre' => 'required',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);
        $recepcionista = Recepcionista::findOrfail($id);
        $recepcionista->update(request()->all());
        return redirect()->route('recepcionistas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recepcionista = Recepcionista::findOrfail($id);
        $recepcionista->delete();
        return redirect()->route('recepcionistas.index');
    }
}
