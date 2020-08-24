<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends VerifyEmailBase
{
    //use Queueable;

    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->greeting("¡Hola ".$notifiable->name."!,")
            ->subject(Lang::get('Verificar dirección de correo'))
            ->line(Lang::get('Haga clic en el siguiente botón para verificar su dirección de correo electrónico.'))
            ->action(
                Lang::get('Verificar dirección de correo'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::get('Si no ha creado una cuenta, no se requiere ninguna otra acción.'));
    }
}
