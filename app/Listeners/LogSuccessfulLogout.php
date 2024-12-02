<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = $event->user;
        activity()
            ->causedBy($user)
            ->withProperties(['ip_address' => request()->ip()])
            ->log('Usuario ' . $user->email . ' ha cerrado sesión');
    }
}
