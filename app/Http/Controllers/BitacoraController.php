<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\View;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Se proporcionó un rango de fechas, aplicar el filtro
            $activities = Activity::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->get();
        } else {
            // No se proporcionó un rango de fechas, cargar todas las actividades
            $activities = Activity::all();
        }

        if ($request->ajax()) {
            $view = View::make('partials.activities_table', compact('activities'))->render();

            return response()->json([
                'view' => $view
            ]);
        }
        $heads = [
            'id',
            'IP',
            'Nombre Usuario',
            'Actividad',
            'Fecha',

        ];
        return view('VistaBitacora.index', compact('heads', 'activities', 'start_date', 'end_date'));
    }


    public function index(Request $request)
    {
        $heads = [
            'id',
            'IP',
            'Nombre Usuario',
            'Actividad',
            'Fecha',
        ];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Se proporcionó un rango de fechas, aplicar el filtro
            $activities = Activity::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->get();
        } else {
            // No se proporcionó un rango de fechas, cargar todas las actividades
            $activities = Activity::all();
        }

        if ($request->ajax()) {
            $view = View::make('partials.activities_table', compact('activities'))->render();

            return response()->json([
                'view' => $view
            ]);
        }

        return view('VistaBitacora.index', compact('heads', 'activities', 'start_date', 'end_date'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bitacora $bitacora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bitacora $bitacora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bitacora $bitacora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bitacora $bitacora)
    {
        //
    }
}
