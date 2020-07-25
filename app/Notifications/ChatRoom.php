<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ChatRoom extends Notification
{
    use Queueable;

    public $fromUser;
    public $message;
    public $time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fromUser, $message, $chatRoomId, $time)
    {
        $this->fromUser = $fromUser;
        $this->message = $message;
        $this->time = $time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        /**
         * Si el usuario está conectado envía solo la notificación mediante la aplicación, en caso contrario envía
         * también una notificación por correo electrónico
         */
        return ($notifiable->status)?['database', 'broadcast']:['mail', 'database', 'broadcast'];
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
                    ->subject('Nuevo mensaje de chat recibido')
                    ->line('Has recibido un nuevo mensaje de ' . $this->fromUser->name)
                    ->line('"'.$this->message.'"')
                    ->line('Puedes ver el mensaje desde la plataforma de Ventonic en el apartado chat.');
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
            'icon' => 'icon-message-square',
            'title' => 'Nuevo mensaje de ' . $this->fromUser->name,
            'link' => route('chat'),
            'text'=>  $this->message,
            'time'=> $this->time
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'icon' => 'icon-message-square',
            'title' => 'Nuevo mensaje de ' . $this->fromUser->name,
            'link' => route('chat'),
            'text'=>  $this->message,
            'time'=> $this->time
        ]);
    }
}
