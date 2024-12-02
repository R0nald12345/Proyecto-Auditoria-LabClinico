<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\TipoSeguro;
use App\Models\User;
use App\Models\Historial;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'Ci',
            'Nombre',
            'FechaNacimiento',
            'sexo',
            'Telefono',
            'Tipo de Seguro',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $pacientes = Paciente::all();
        $seguros = TipoSeguro::all();
        // $pacientes->each(function ($paciente) {
        //     $paciente->tipoSeguro = $paciente->tipoSeguro->descripcion;
        // });
        // dd($pacientes);
        return view('pacientes.index', compact('pacientes', 'heads', 'seguros'));
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
            'idTipoSeguro' => 'required',
            'email' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ])->assignRole('Paciente');



        $historial = new Historial();
        $historial->nroHistoria = $request->ci;
        $historial->fechaRegistro = date('Y-m-d');
        $historial->antecedentesPatologicos = 'Ninguno';
        $historial->save();

        $paciente = new Paciente();
        $paciente->ci = $request->ci;
        $paciente->nombre = $request->nombre;
        $paciente->fechaNacimiento = $request->fechaNacimiento;
        $paciente->sexo = $request->sexo;
        $paciente->telefono = $request->telefono;
        $paciente->idTipoSeguro = $request->idTipoSeguro;
        $paciente->idHistorial = $historial->id;
        $paciente->idUser = $user->id;
        $paciente->save();
        
        activity()
        ->causedBy(auth()->user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('Registro un paciente con el nombre: ' . $paciente->nombre);
    session()->flash('success', 'Se registró exitosamente');
        return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
      $seguros = TipoSeguro::all();

      return view('pacientes.edit', compact('paciente', 'seguros'));
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
            'idTipoSeguro' => 'required',

        ]);

        $paciente = Paciente::findOrFail($id);

        $paciente->update($request->all());


        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $id = $paciente->idUser;
        $paciente->delete();
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('pacientes.index')->with('deleted', 'Paciente eliminado con éxito');

    }
}
