<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        activity()
            ->causedBy($user)
            ->withProperties(['ip_address' => request()->ip()])
            ->log('Usuario ' . $user->email . ' ha iniciado sesión');
            
    }
}
