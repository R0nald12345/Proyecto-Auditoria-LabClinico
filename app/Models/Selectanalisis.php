<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selectanalisis extends Model
{
    use HasFactory;

    protected $table = 'selectanalises'; // Nombre de la tabla si es diferente
    protected $fillable = [
        'idTipoanalisis',
        'idOrden',
    ];

    // Relación con Analisistotal
    public function analisistotal()
    {
        return $this->belongsTo(analisistotal::class, 'idTipoanalisis');
    }
}
