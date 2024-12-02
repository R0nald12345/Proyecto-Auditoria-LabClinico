<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Registro extends Model
{
    use HasFactory;
    protected $table = 'registros';
    protected $fillable = [
        'tipo_analisis',
        'fecha',
        'doctor',
        'precion_arterial',
        'peso',
        'altura',
        'notas',
        'idBioquimico',
        'idHistorial',
    ];


    public function historial()
    {
        return $this->belongsTo(Historial::class, 'idHistorial');
    }
}
