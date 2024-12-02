<?php

namespace App\Http\Controllers;

use App\Models\Bioquimico;
use App\Models\Orden;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
    //     $admin = User::all();
    //     $recepcionistas = Recepcionista::count();
    //     $bioquimicos = Bioquimico::count();
    //     $pacientes = Paciente::count();
    //     $fecha = $request->fecha ? Carbon::parse($request->fecha) : Carbon::now();
    //     $cantidadOrdenes = Orden::whereDate('created_at', '=', $fecha->toDateString())->count();
    //     return view('home', compact('admin', 'recepcionistas', 'bioquimicos', 'pacientes', 'cantidadOrdenes', 'fecha'));
    // }

    //     public function index(Request $request)
    // {
    //     $fechaSeleccionada = $request->input('fecha', Carbon::now()->format('Y-m'));
    //     $cantidadOrdenes = Orden::whereDate('created_at', '=', $fechaSeleccionada->toDateString())->count();
    //     return view('home', compact('fechaSeleccionada'));
    // }

    public function index(Request $request)
    {
        // Obtener la fecha seleccionada por el usuario
        $fechaSeleccionada = $request->input('fecha', Carbon::now()->format('Y-m'));

        // Obtener el primer día y el último día del mes seleccionado
        $primerDiaMes = Carbon::parse($fechaSeleccionada)->startOfMonth();
        $ultimoDiaMes = Carbon::parse($fechaSeleccionada)->endOfMonth();

        // Obtener las órdenes para el mes seleccionado
        $ordenesPorFecha = Orden::whereBetween('created_at', [$primerDiaMes, $ultimoDiaMes])
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })
            ->map(function ($item) {
                return count($item);
            });

            $CantAdmin = User::all();
            $CantRecepcionistas = Recepcionista::count();
            $CantBioquimicos = Bioquimico::count();
            $CantPacientes = Paciente::count();
        return view('home', compact('fechaSeleccionada', 'ordenesPorFecha', 'CantAdmin', 'CantRecepcionistas', 'CantBioquimicos', 'CantPacientes'));
    }
}
