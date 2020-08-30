<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class VerifyEmail extends TemplateMailable
{
    use Queueable, SerializesModels;

    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string Nombre del usuario registrado */
    public $name;
    /** @var string URL de verificación */
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }
}
