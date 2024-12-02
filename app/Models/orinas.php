<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orinas extends Model
{
    use HasFactory;
    protected $table = 'orina_completa';
    protected $fillable = ['id'];
    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'idAnalisis');
    }
}
