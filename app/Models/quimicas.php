<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quimicas extends Model
{
    use HasFactory;

    protected $table = 'quimica_sanguinea'; // Nombre correcto de la tabla en la base de datos

    protected $fillable = ['id'];

    // Relación con el modelo Analisis (asumo que existe esta relación basada en tu código)
    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'idAnalisis');
    }
}
