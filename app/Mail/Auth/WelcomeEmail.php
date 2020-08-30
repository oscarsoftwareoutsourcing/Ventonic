<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class WelcomeEmail extends TemplateMailable
{
    use Queueable, SerializesModels;

    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string Nombre de la aplicación */
    public $appName;
    /** @var string Nombre del usuario verificado */
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appName, $userName)
    {
        $this->appName = $appName;
        $this->userName = ucfirst($userName);
    }
}
