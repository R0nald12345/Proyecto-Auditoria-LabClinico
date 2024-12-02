<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSeguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'descuento',
    ];

    protected $table = 'tipo_seguros';

    public function Pacientes()
    {
        return $this->hasMany(Paciente::class, 'idTipoSeguro', 'id');
    }
}
