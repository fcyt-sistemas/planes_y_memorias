<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    public $actionUrl;
 
    public function __construct($token)
    {
        $this->actionUrl = action('Auth\ResetPasswordController@showResetForm',$token);
    }
 
    public function via($notifiable)
    {
        return ['mail'];
    }
 
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('fcyt_sistemas@uader.edu.ar','Departamento de Sistemas FCYT - UADER')
            ->subject('Reiniciar Contraseña')
            ->greeting('Hola!')
            ->salutation('Muchas gracias!')
            ->line('Enviamos este email porque recibimos una solicitud de cambio de contraseña para su cuenta.')
            ->action('Reiniciar su Contraseña', $this->actionUrl)
            ->line('Si Ud. no realizó esta solicitud, desestime este correo y elimínelo sin problemas.');
    }
 
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
