<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Welcome extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject(__('Bienvenido') . ' - ' . config('app.name'))
                    ->line(__('Bienvenido :user, has sido verificado correctamente en nuestro sistema.', [
                        'user' => $this->user
                    ]))
                    ->line('Ya puede hacer uso de todas las funcionalidades.')
                    ->line('Gracias por usar nuestra aplicación!')
                    ->line(
                        'Este correo es enviado de manera automática por la aplicación y no esta siendo ' .
                        'monitoreado. Por favor no responda a este correo!'
                    );
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
