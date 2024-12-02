<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Historial;
use App\Models\Orden;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function getHistorial()
    {
        $user = Auth::user();
        $paciente = $user->paciente;
        if ($paciente) {
            $historial = $paciente->historial;
            return response()->json($historial, 200);
        } else {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
    }

}
