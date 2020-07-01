<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaInvitacionRecibida extends Mailable
{
    use Queueable, SerializesModels;

    // public $codigo_confirmacion;
    public $name_group;
    public $url;
    public function __construct($name_group, $url)
    {
        $this->name_group =$name_group;
        $this->url =$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.invitationGroup');
    }
}
