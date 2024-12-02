<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        activity()
        ->causedBy(Auth::user())
        ->withProperties(request()->ip()) // Obtener la dirección IP del usuario
        ->log('cerro sesion');
    session()->flash('success', 'Se registró exitosamente');
        return $request->expectsJson() ? null : route('login');
    }
}
