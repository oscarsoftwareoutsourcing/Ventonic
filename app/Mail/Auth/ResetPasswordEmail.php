<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class ResetPasswordEmail extends TemplateMailable
{
    use Queueable, SerializesModels;

    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string URL del formulario para actualizar la contraseña */
    public $url;
    /** @var string Tiempo de expiración del enlace */
    public $countExpire;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $countExpire)
    {
        $this->url = $url;
        $this->countExpire = $countExpire;
    }
}
