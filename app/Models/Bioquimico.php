<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioquimico extends Model
{
    use HasFactory;
    protected $table = 'bioquimicos';

    protected $fillable = [
        'ci',
        'direccion',
        'nombre',
        'fechaNacimiento',
        'sexo',
        'telefono',
        'idEspecialidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function analisis()
    {
        return $this->hasMany(Analisis::class, 'idBioquimico');
    }


    // public function historial()
    // {
    //     return $this->belongsTo(Historial::class, 'idHistorial', 'id');
    // }
    // public function historial()
    // {
    //     return $this->hasOne(Historial::class, 'id', 'idHistorial');
    // }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'idEspecialidad', 'id');
    }

  
}
