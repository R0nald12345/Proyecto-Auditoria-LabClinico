<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoAnalisis;
use Illuminate\Validation\ValidationException;

class AnalysisTypeController extends Controller
{
    public function index()
    {
        $analysisTypes = TipoAnalisis::all();
        return $analysisTypes; //return all data
    }

}
