<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyAplicantOportunity extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postulation, $oportunity_title, $seller_name)
    {
        $this->postulation =$postulation;
        $this->oportunity_title =$oportunity_title;
        $this->seller_name =$seller_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('Un nuevo candidato se ha inscrito a la Oportunidad '.$this->oportunity_title)
                    ->line('Puede consultar el perfil del desde la plataforma de Ventonic en el apartado Oportunidades/Mis candidaturas.');
                    // ->action('Notification Action', url('/'))
                    // ->line('Un saludo,')
                    // ->line('Equipo de Ventonic.');
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

     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'aplicantName'=>$notifiable->name,
            'oportunityName'=>$this->oportunity_title,
            'sellerName'=>$this->seller_name
        ];
    }
}
