<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use Illuminate\Http\Request;

class ReportepagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = ['Id','Cliente', 'Metodo','Fecha', 'Hora', 'Monto','Estado'];
        $notaventa = NotaVenta::all();
        return view('ReportesPago.index', compact('heads', 'notaventa'));
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
    public function show(NotaVenta $reportepagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaVenta $reportepagos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaVenta $reportepagos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaVenta $reportepagos)
    {
        //
    }
}
