<?php

namespace App\Http\Controllers;

use App\Models\Quimicas;
use App\Models\QuimicaSanguinea;
use Illuminate\Http\Request;

class QuimicaSanguineaController extends Controller
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
        $quimicas = Quimicas::where('idAnalisis', $id)->get();
        return view('quimica.index', compact('quimicas', 'heads','id'));
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
    public function show(QuimicaSanguinea $quimicaSanguinea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuimicaSanguinea $quimicaSanguinea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuimicaSanguinea $quimicaSanguinea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuimicaSanguinea $quimicaSanguinea)
    {
        //
    }
}
