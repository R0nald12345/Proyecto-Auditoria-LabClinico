<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HemogramaCompleto extends Model
{
    use HasFactory;
    protected $fillable = [
        'globulosRojos',
        'hematocrito',
        'hemoglobina',
        'VCM',
        'HCM',
        'CHCM',
        'VSG',
        'plaquetas',
        'recuento',
        'globulosBlancos',
        'promielocitos',
        'mielocitos',
        'metamielocitos',
        'cayados',
        'segmentados',
        'linfocitos',
        'monocitos',
        'eosinofilos',
        'basofilos',
        'blastos',
        'grupoSanguineo',
        'factorRh',
        'precio',
        'estado',
        'descripcion',
        'idAnalisis'
    ];
    
    protected $table = 'hemograma_completos';
    
    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'idAnalisis');
    }
    

}
