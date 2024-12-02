<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuimicaSanguinea extends Model
{
    use HasFactory;
    protected $table = 'quimica_sanguinea'; // Nombre correcto de la tabla
    protected $fillable = ['id'];
    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'idAnalisis');
    }
}
