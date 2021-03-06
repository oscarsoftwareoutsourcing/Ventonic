<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class NuevaInvitacionRecibida extends TemplateMailable
{
    use Queueable, SerializesModels;
    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    // public $codigo_confirmacion;
    /** @var string Nombre del grupo */
    public $name_group;
    /** @var string URL de invitación al grupo */
    public $url;

    public function __construct($name_group, $url)
    {
        $this->name_group = $name_group;
        $this->url = $url;
    }
}
