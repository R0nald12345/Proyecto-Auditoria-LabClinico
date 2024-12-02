<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analisis;
use App\Models\CourseStudent;
use App\Models\NotaVenta;
use App\Models\Orden;
use App\Models\ordenAnalisis;
use App\Models\Paciente;
use App\Models\Solicitud;
use App\Models\TipoAnalisis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NotaVentaController extends Controller
{
    public function getNotasVentaConAnalisis(Request $request)
    {
        try {
            // Obtiene los datos del usuario autenticado
            $user = Auth::user();
            Log::info('Usuario autenticado: ', ['user' => $user]);

            // Relaciona el user con su paciente
            $paciente = Paciente::where('idUser', $user->id)->first();
            if (!$paciente) {
                throw new \Exception('Paciente no encontrado para el usuario autenticado');
            }
            Log::info('Paciente encontrado: ', ['paciente' => $paciente]);

            // Obtener todas las notas de venta del paciente con los tipos de análisis
            $notasVenta = NotaVenta::whereHas('orden', function ($query) use ($paciente) {
                $query->where('idPaciente', $paciente->id);
            })->with(['orden.tipoanalisis'])->get();

            // Formatear la respuesta para incluir los tipos de análisis y sus costos
            $formattedNotasVenta = $notasVenta->map(function ($notaVenta) {
                $orden = $notaVenta->orden;
                return [
                    'id' => $notaVenta->id,
                    'metodoPago' => $notaVenta->metodoPago,
                    'precioTotal' => $notaVenta->precioTotal,
                    'orden' => [
                        'nroOrden' => $orden->nroOrden,
                        'estado' => $orden->estado,
                        'tipoAnalisis' => $orden->tipoanalisis->map(function ($tipoAnalisis) {
                            return [
                                'nombre' => $tipoAnalisis->nombre,
                                'precio' => $tipoAnalisis->precio,
                                'descripcion' => $tipoAnalisis->descripcion,
                            ];
                        })
                    ]
                ];
            });

            Log::info('Notas de venta formateadas: ', ['formattedNotasVenta' => $formattedNotasVenta]);

            return response()->json($formattedNotasVenta, 200);
        } catch (\Exception $e) {
            Log::error('Error al obtener las notas de venta: ', ['exception' => $e]);
            return response()->json(['error' => 'Error al obtener las notas de venta.', 'details' => $e->getMessage()], 500);
        }
    }
}
