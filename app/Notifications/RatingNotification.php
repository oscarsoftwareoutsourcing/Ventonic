<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class RatingNotification extends Notification
{
    use Queueable;

    protected $rateUser;
    protected $fromEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rateUser, $fromEmail)
    {
        $this->rateUser = $rateUser;
        $this->fromEmail = $fromEmail;
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
        $url = URL::signedRoute('valorar', ['user' => $this->rateUser->id, 'from' => $this->fromEmail]);
        return (new MailMessage)
                    ->from($this->rateUser->email, $this->rateUser->name)
                    ->subject('Valora a ' . $this->rateUser->name)
                    ->line(
                        'Deja un comentario de tu experiencia. Valora la profesionalidad, amabilidad,
                        disponibilidad del vendedor con el que has trabajado, así como cualquier otro
                        aspecto que quieras compartir para que el resto de Empresas que accedan a su
                        perfil puedan conocer.'
                    )
                    ->line('Valora tu experiencia en Ventonic con ' . $this->rateUser->name)
                    ->action('Valorar', $url);
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
