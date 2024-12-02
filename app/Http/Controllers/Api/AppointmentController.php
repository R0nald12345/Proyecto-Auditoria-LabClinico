<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analisis;
use App\Models\analisistotal;
use App\Models\CourseStudent;
use App\Models\HemogramaCompleto;
use App\Models\NotaVenta;
use App\Models\Orden;
use App\Models\ordenAnalisis;
use App\Models\Paciente;
use App\Models\Selectanalisis;
use App\Models\Solicitud;
use App\Models\TipoAnalisis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $paciente = Paciente::where('idUser', $user->id)->first();
            if (!$paciente) {
                return response()->json(['error' => 'Paciente no encontrado.'], 404);
            }
            $ordenes = Orden::where('idPaciente', $paciente->id)->with('analisis')->get();
            return response()->json($ordenes, 200);
        } catch (\Exception $e) {
            Log::error('Error al obtener las órdenes: ', ['exception' => $e]);
            return response()->json(['error' => 'Error al obtener las órdenes.', 'details' => $e->getMessage()], 500);
        }
    }

    public function registerOrder(Request $request)
    {
        try {
            $datos = $request->all();
            if (count($datos) > 0) {
                // Obtiene los datos del usuario autenticado
                $user = Auth::user();
                // relaciona el user con su paciente
                $paciente = Paciente::where('idUser', $user->id)->first();
                if (!$paciente) {
                    return response()->json(['error' => 'Paciente no encontrado.'], 404);
                }

                $orden = new Orden();
                $orden->idPaciente = $paciente->id;
                $orden->save();

                // Después de guardar la orden, obtén el ID asignado
                $idOrden = $orden->id;
                // Asigna el número de orden con 'OR' concatenado con el ID
                $orden->nroOrden = 'OR' . $idOrden;
                $orden->save();

                $montoTotal = 0;
                // Procesar los tipos de análisis recibidos
                foreach ($datos as $analysisType) {
                    $montoTotal = $montoTotal + floatval($analysisType['precio']);

                    // Relacionar la orden con el tipo de análisis en la tabla orden_analisis
                    DB::table('orden_analisis')->insert([
                        'orden_id' => $orden->id,
                        'tipo_analisis_id' => intval($analysisType['id']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    /*
                    ordenAnalisis::create([
                        'orden_id' => $orden->id,
                        'tipo_analisis_id' => intval($analysisType['id']),
                    ]);
                    */

                    // Crear un nuevo análisis para la orden
                    $analisis = new Analisis();
                    $analisis->estado = 'Pendiente';
                    $analisis->descripcion =  $analysisType['nombre']; // Acceder al nombre del tipo de análisis
                    $analisis->idOrden = $idOrden;
                    $analisis->save();

                    // Obtener todos los atributos correspondientes al tipo de análisis
                    $atributos = analisistotal::where('tipo', $analysisType['nombre'])->get();

                    // Relacionar la orden con los atributos en la tabla selectanalises
                    foreach ($atributos as $atributo) {
                        Selectanalisis::create([
                            'idTipoanalisis' => $atributo->id,
                            'idOrden' => $orden->id,
                        ]);
                    }
                }

                // Crear la nota de venta
                $notaventa = NotaVenta::create([
                    'metodoPago' => 'Paypal',
                    'precio' => $montoTotal,
                    'descuento' => 0,
                    'precioTotal' => $montoTotal,
                ]);

                $orden->idNotaVenta = $notaventa->id;
                $orden->save();

                $ordenes = Orden::where('idPaciente', $paciente->id)->with('analisis')->get();
                return response()->json($ordenes, 201);
            } else {
                return response()->json(['error' => 'Datos insuficientes para registrar la orden.'], 400);
            }
            
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error en el registro de orden: ', ['exception' => $e]);

            // Devolver una respuesta de error
            return response()->json(['error' => 'Error en el registro de orden.'], 500);
        }
    }

    public function getallanalysis($analysisId)
    {    
        try {
            $hemograma = HemogramaCompleto::where('idAnalisis', $analysisId)->first();
            if (!$hemograma) {
                return response()->json(['error' => 'Análisis no encontrado.'], 404);
            }
            return response()->json($hemograma, 200);
        } catch (\Exception $e) {
            Log::error('Error al obtener el análisis: ', ['exception' => $e]);
            return response()->json(['error' => 'Error al obtener el análisis.', 'details' => $e->getMessage()], 500);
        }
    }
}
