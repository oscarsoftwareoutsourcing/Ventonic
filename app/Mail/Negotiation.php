<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class Negotiation extends TemplateMailable
{
    //use Queueable, SerializesModels;
    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string Nombre del usuario que envía el correo */
    public $fromUserName;
    /** @var string Correo electrónico del usuario que envía */
    public $fromUserEmail;
    /** @var string Asunto del correo */
    public $subject;
    /** @var string Mensaje del correo */
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromUserEmail, $fromUserName, $subject, $msg)
    {
        $this->fromUserEmail = $fromUserEmail;
        $this->fromUserName = $fromUserName;
        $this->subject = $subject;
        $this->msg = $msg;
    }
}
