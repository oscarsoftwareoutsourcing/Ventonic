<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ExitGroup extends Notification
{
    use Queueable;

    public $nameGroup;
    public $userName;
    public $url;
    public $time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nameGroup, $userName, $url, $time)
    {
        $this->nameGroup = $nameGroup;
        $this->userName = $userName;
        $this->url = $url;
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
        return ['mail', 'database', 'broadcast'];
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
                    ->subject('Un usuario ha salido del grupo '.$this->nameGroup)
                    ->line('El usuario '.$this->userName.' ha salido del grupo ' . $this->nameGroup . '.');
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
            'icon' => 'icon-users',
            'title' => 'Nuevo mensaje del grupo ' . $this->nameGroup,
            'link' => $this->url,
            'text'=>  'El usuario ' . $this->userName . ' se ha dado de baja del grupo',
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
            'icon' => 'icon-users',
            'title' => 'Nuevo mensaje del grupo ' . $this->nameGroup,
            'link' => $this->url,
            'text'=>  'El usuario ' . $this->userName . ' se ha dado de baja del grupo',
            'time'=> $this->time
        ]);
    }
}
