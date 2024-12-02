<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcionista extends Model
{
    use HasFactory;

    protected $table = 'recepcionistas';

    protected $fillable = [
        'ci',
        'nombre',
        'fechaNacimiento',
        'sexo',
        'telefono',
        'direccion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
