<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'idUser', 'id');
    }

    public function recepcionista()
    {
        return $this->hasOne(Recepcionista::class, 'idUser', 'id');
    }

    public function adminlte_desc()
    {
        //$user = auth()->user();
        //$roles = $user->roles->pluck('name')->implode(', ');

        return auth()->user()->name;
    }


    public function Comentarios()
    {
        return $this->hasMany(Comentario::class, 'id', 'user_id');
    }


}
