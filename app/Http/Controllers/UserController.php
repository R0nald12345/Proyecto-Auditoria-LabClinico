<?php

namespace App\Http\Controllers;

use App\Models\Bioquimico;
use App\Models\Historial;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\TipoSeguro;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = [
            'ID',
            'Nombre',
            'Email',
            'Roles',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $users = User::with('roles')->get();
        $roles = Role::pluck('name', 'id');
        return view('users.index', compact('users', 'roles', 'heads'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $seguros = TipoSeguro::all();
        return view('users.create', compact('roles', 'seguros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación común para todos los roles
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name',
        ]);

        try {

            // Lógica para el guardado dependiendo del rol seleccionado
            switch ($request->role) {
                case 'Paciente':
                    $request->validate([
                        'ci' => 'required|string|max:255|unique:pacientes',
                        'nombre' => 'required|string|max:255',
                        'fechaNacimiento' => 'required|date',
                        'sexo' => 'required|in:M,F',
                        'telefono' => 'required|string|max:255',
                        'idTipoSeguro' => 'required',
                    ]);
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ])->assignRole($request->role);

                    $historial = Historial::create([
                        'nroHistoria' => $request->ci,
                        'fechaRegistro' => date('Y-m-d'),
                        'antecedentesPatologicos' => 'Ninguno',
                    ]);

                    Paciente::create([
                        'ci' => $request->ci,
                        'nombre' => $request->nombre,
                        'fechaNacimiento' => $request->fechaNacimiento,
                        'sexo' => $request->sexo,
                        'telefono' => $request->telefono,
                        'idTipoSeguro' => $request->idTipoSeguro,
                        'idHistorial' => $historial->id,
                        'idUser' => $user->id,
                    ]);
                    break;
                case 'Bioquimico':
                    $request->validate([
                        'ci' => 'required|string|max:255|unique:bioquimicos',
                        'nombre' => 'required|string|max:255',
                        'fechaNacimiento' => 'required|date',
                        'sexo' => 'required|in:M,F',
                        'telefono' => 'required|string|max:255',
                        'direccion' => 'required|string|max:255',
                    ]);
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ])->assignRole($request->role);
                    Bioquimico::create([
                        'ci' => $request->ci,
                        'nombre' => $request->nombre,
                        'fechaNacimiento' => $request->fechaNacimiento,
                        'sexo' => $request->sexo,
                        'telefono' => $request->telefono,
                        'direccion' => $request->direccion,
                        'idUser' => $user->id,
                    ]);
                    break;
                case 'Recepcionista':
                    $request->validate([
                        'ci' => 'required|string|max:255|unique:recepcionistas',
                        'nombre' => 'required|string|max:255',
                        'fechaNacimiento' => 'required|date',
                        'sexo' => 'required|in:M,F',
                        'telefono' => 'required|string|max:255',
                        'direccion' => 'required|string|max:255',
                    ]);
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ])->assignRole($request->role);
                    Recepcionista::create([
                        'ci' => $request->ci,
                        'nombre' => $request->nombre,
                        'fechaNacimiento' => $request->fechaNacimiento,
                        'sexo' => $request->sexo,
                        'telefono' => $request->telefono,
                        'direccion' => $request->direccion,
                        'idUsuario' => $user->id,
                    ]);
                    break;
                default:
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ])->assignRole($request->role);
                    break;
            }
            activity()
            ->causedBy(auth()->user())
            ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
            ->log('Registro un usuario: ' . $user->name);
        session()->flash('success', 'Se registró exitosamente');
            // Redireccionar o devolver una respuesta según corresponda
            return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // El código de error 1062 indica una violación de la restricción de unicidad
                $message = 'El campo CI debe ser único.';
            } else {
                // Otro tipo de excepción de base de datos
                $message = $e->getMessage();
            }
            return back()->withErrors(['error' => $message])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logoutBrowser(Request $request)
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Registrar el cierre del navegador en el registro de actividad
  //  Log::info('El usuario ' . $user->name . ' ha cerrado el navegador.');
    activity()
    ->causedBy(auth()->user())
    ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
    ->log('cerro el navegador');
session()->flash('success', 'Se registró exitosamente');
    // Puedes hacer otras acciones aquí si lo deseas

    return response()->json(['message' => 'Registro de cierre de navegador exitoso'], 200);
}

public function logWindowClose(Request $request)
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Registrar el cierre de ventana en el registro de actividad
    activity()
        ->causedBy($user)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cerró una ventana del navegador');

    return response()->json(['message' => 'Registro de cierre de ventana exitoso'], 200);
}
}
