<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAnalisis extends Model
{
    use HasFactory;
    protected $table = 'tipo_analisis';
    protected $fillable = ['nombre','precio','descripcion'];

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'orden_analisis','tipo_analisis_id','orden_id');
    }
}
