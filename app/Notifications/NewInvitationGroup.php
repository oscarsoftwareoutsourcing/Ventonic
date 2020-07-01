<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInvitationGroup extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $name_group;
    public $url;
    public function __construct($name_group, $url)
    {
        $this->name_group =$name_group;
        $this->url =$url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("Hola ".$notifiable->name.",")
                    ->subject('Invitación al grupo '.$this->name_group.' de usuarios recibida!')
                    ->line('Has sido invitado a unirte al grupo '.$this->name_group)
                    ->line('Para aceptar la invitación visite el siguiente link.')
                    ->action('Ver invitación', url(env('APP_URL').'/acceso'))
                    ->line('y encuentrala en tu perfil,');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
