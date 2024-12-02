<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;


    protected $table = 'comentarios';
    protected $fillable = ['body', 'user_id'];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }  
}
