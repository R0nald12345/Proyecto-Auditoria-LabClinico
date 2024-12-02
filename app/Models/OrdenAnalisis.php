<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordenAnalisis extends Model
{
    use HasFactory;
    protected $table = 'orden_analisis';
    protected $fillable = ['orden_id', 'tipo_analisis_id'];


    public function tipoAnalisis()
    {
        return $this->belongsTo(TipoAnalisis::class, 'tipo_analisis_id');
    }
   

}

