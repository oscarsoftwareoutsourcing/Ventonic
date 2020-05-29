<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerAplicantOportunity extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postulation, $oportunity_title)
    {
        $this->postulation =$postulation;
        $this->oportunity_title =$oportunity_title;
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
            ->subject('Nueva postulacion recibida')
            ->line('Se ha inscrito en la Oportunidad '.$this->oportunity_title)
            ->line('Puede seguir es estado de su candidatura desde la plataforma de Ventonic en el apartado Oportunidades/Mis candidaturas.');
            // ->action('Notification Action', url('/'))    
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
