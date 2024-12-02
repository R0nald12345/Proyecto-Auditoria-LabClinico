<?php

namespace App\Http\Controllers;

use App\Models\OrinaCompleta;
use App\Models\Orinas;
use Illuminate\Http\Request;

class OrinaCompletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function show2(string $id)
    {
        $heads = [
            'Orden',
            'Id',
            'Bioquimico',
            'Paciente',
            'Fecha',
            ['label' => 'Acciones', 'no-export' => true],
        ];
        $orinas = Orinas::where('idAnalisis', $id)->get();
        return view('orina.index', compact('orinas', 'heads','id'));
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
    public function show(OrinaCompleta $orinaCompleta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrinaCompleta $orinaCompleta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrinaCompleta $orinaCompleta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrinaCompleta $orinaCompleta)
    {
        //
    }
}
