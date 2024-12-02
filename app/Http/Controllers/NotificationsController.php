<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;

class NotificationsController extends Controller
{
    public function getNotificationsData(Request $request)
        {

            $id = auth()->user()->id;
            $paciente = Paciente::where('idUser', $id)->first();


 


            $notificaciones = $paciente->notificaciones->where('read', 0);

             
            
            // $cantidad_notificaciones = $notificaciones->count();
            
            foreach ($notificaciones as $notificacion) {

                    $analisis = Analisis::find($notificacion->analisisId);

                    
                    

                    if($analisis->HemogramaCompleto){
                        $analisis_nombre = 'hemograma';
                        $id = $analisis->HemogramaCompleto->id;
                        
                    }
                    if($analisis->Hormonas){
                        $analisis_nombre = 'hormonas';
                        $id = $analisis->Hormonas->id;
                    }

                    

                      
       
                     $tiempo = $notificacion->created_at->diffForHumans();
                    // $tiempo = $tarea->comentarios->last()->created_at->diffForHumans();

                    $notifications[] = [

                            'icon' => 'fas fa-fw fa-file text-danger',
                            'text' => ' Tiene un nuevo resultado de  ' . $analisis_nombre,
                            'time' => $tiempo,
                            // 'route' => '/tareas/' . $tarea->id,
                            'route' => '/' .$analisis_nombre. '/' . $id,

                    ];
                
            }


            // Now, we create the notification dropdown main content.

            $dropdownHtml = '';

            foreach ($notifications as $key => $not) {
                $icon = "<i class='mr-2 {$not['icon']}'></i>";

                $time = "<span class='float-right text-muted text-sm'>
                        {$not['time']}
                        </span>";

                $dropdownHtml .= "<a href='{$not['route']}' class='dropdown-item'>
                                    {$icon}{$not['text']}{$time}
                                </a>";

                if ($key < count($notifications) - 1) {
                    $dropdownHtml .= "<div class='dropdown-divider'></div>";
                }
            }

            // Return the new notification data.

            return [
                'label' => count($notifications),
                'label_color' => 'danger',
                'icon_color' => 'dark',
                'dropdown' => $dropdownHtml,
            ];


            
        }
}
