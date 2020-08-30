<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class GroupInvitation extends TemplateMailable
{
    use Queueable, SerializesModels;

    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string Nombre del usuario a invitar */
    public $name;
    /** @var string Nombre del grupo al cual ha sido invitado */
    public $groupName;
    /** @var string URL de aceptación para unirse al grupo */
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $groupName, $url)
    {
        $this->name = $name;
        $this->groupName = $groupName;
        $this->url = $url;
    }
}
