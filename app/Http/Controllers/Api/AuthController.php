<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Bioquimico;
use App\Models\CourseStudent;
use App\Models\CourseSubject;
use App\Models\Historial;
use App\Models\Notice;
use App\Models\NoticeFile;
use App\Models\Paciente;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        $user = array(); //this will return a set of user and doctor data
        $useraux = Auth::user();
        $user['id'] = $useraux->id;
        $user['name'] = $useraux->name;
        $user['email'] = $useraux->email;
        //$paciente = Paciente::find($user->id);
        $paciente = Paciente::where('idUser', $useraux->id)->first();
        //$bioquimico = Bioquimico::where('idUser', $useraux->id)->first();
        //$bioquimico = Bioquimico::find($user->id);
        if ($paciente !== null) {
            $user['ci'] = $paciente->ci;
            $user['nombre'] = $paciente->nombre;
            $user['fechaNacimiento'] = $paciente->fechaNacimiento;
            $user['sexo'] = $paciente->sexo;
            $user['telefono'] = $paciente->telefono;
            $user['tipo'] = 'Paciente';
        } else {
            $user['tipo'] = 'Otro';
        }

        return $user; //return all data
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscamos el usuario por el email
        $user = User::where('email', $request->email)->first();

        // Verificamos que el usuario exista y que la contraseña sea correcta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        // Verificamos que el usuario tenga el rol 'Paciente'
        if (!$user->hasRole('Paciente')) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        // Generamos el token y lo devolvemos en la respuesta
        return response()->json(['token' => $user->createToken($request->email)->plainTextToken], 200);
    }

    public function register(Request $request)
    {
        try {
            // Validar los datos entrantes
            $validatedData = $request->validate([
                'email' => 'required',
                'password' => 'required',
                'ci' => 'required',
                'nombre' => 'required',
                'fechaNacimiento' => 'required|date',
                'sexo' => 'required',
                'telefono' => 'required',
            ]);

            // Crear el usuario
            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ])->assignRole('Paciente');

            // Crear el historial
            $historial = Historial::create([
                'nroHistoria' => $request->ci,
                'fechaRegistro' => date('Y-m-d'),
                'antecedentesPatologicos' => 'Ninguno',
            ]);

            // Crear el paciente
            $paciente = Paciente::create([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'fechaNacimiento' => $request->fechaNacimiento,
                'sexo' => $request->sexo,
                'telefono' => $request->telefono,
                'idHistorial' => $historial->id,
                'idUser' => $user->id,
            ]);

            return response()->json($user, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error en el registro: ', ['exception' => $e]);
            return response()->json(['error' => 'Error en el registro de usuario.'], 500);
        }
    }


    // Verifica si ya existe un paciente con el CI ingresado en el formulario de registro
    public function existsci(Request $request)
    {
        //validate incoming inputs
        $request->validate([
            'ci' => 'required',
        ]);
        /*

        //busca al paciente con determinado ci
        $user = Paciente::where('ci', $request->ci)->first();

        //verifica si existe el usuario con ci mandado en request
        if (!$user) {
            throw ValidationException::withMessages([
                'ci' => ['No existe un paciente con el ci enviado'],
            ]);
        }

        //retorna el paciente
        return $user;
        */

        $exists = Paciente::where('ci', $request->ci)->exists();
        return response()->json($exists);
    }

    // Verifica si ya existe un paciente con el email ingresado en el formulario de registro
    public function existsemail(Request $request)
    {
        //validate incoming inputs
        $request->validate([
            'email' => 'required',
        ]);
        /*

        //busca al paciente con determinado email
        $user = User::where('email', $request->email)->first();

        //verifica si existe el usuario con email mandado en request
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No existe un paciente con el email enviado'],
            ]);
        }

        //retorna el paciente
        return $user;
        */

        //$email = $request->input('email');
        $exists = User::where('email', $request->email)->exists();
        return response()->json($exists);
    }



    public function user()
    {
        return response(auth()->user(), 200);
    }


    // Función para desconectar al usuario
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'Logged out'], 200);
    }

    public function checkStatus(Request $request)
    {
        return response(['user' => $request->user()], 200);
    }
}
