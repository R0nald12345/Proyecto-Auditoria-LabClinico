<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hormonas extends Model
{
    use HasFactory;
    protected $fillable = ['id'];
    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'idAnalisis');
    }
}
