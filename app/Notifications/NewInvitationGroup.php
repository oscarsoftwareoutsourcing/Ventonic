<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\HtmlString;

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
    public $fromUser;
    public $time;

    public function __construct($name_group, $url, $time, $fromUser = null)
    {
        $this->name_group =$name_group;
        $this->url = route('group.confirmInvitation', ['invitacion_id' => $url]);
        $this->fromUser = $fromUser;
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
                    ->greeting("¡Hola ".$notifiable->name."! Ha sido invitado a unirse al grupo " . $this->name_group)
                    ->subject('Nueva invitación recibida')
                    ->line(
                        'Si desea unirse haga click en '.
                        new HtmlString('<a href="'.$this->url.'">este enlace</a>') .
                        ' para registrarse en nuestra plataforma. Una vez registrado encontrarás
                        la invitación en tu perfil.'
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
            'title' => 'Nuevo mensaje de ' . $this->fromUser->name,
            'link' => $this->url,
            'text'=>  'Invitación a ser parte del grupo ' . $this->name_group,
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
            'title' => 'Nuevo mensaje de ' . $this->fromUser->name,
            'link' => $this->url,
            'text'=>  'Invitación a ser parte del grupo ' . $this->name_group,
            'time'=> $this->time
        ]);
    }
}
