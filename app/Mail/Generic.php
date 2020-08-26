<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\EmailTemplate;

class Generic extends TemplateMailable
{
    // usa el modelo personalizado para el registro de plantillas
    protected static $templateModelClass = EmailTemplate::class;

    /** @var string */
    public $fromUserName;
    /** @var string */
    public $fromUserEmail;
    /** @var string */
    public $subject;
    /** @var string */
    public $msg;
    /** @var string */
    public $module;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromUserEmail, $fromUserName, $subject, $msg, $module = null)
    {
        $this->fromUserEmail = $fromUserEmail;
        $this->fromUserName = $fromUserName;
        $this->subject = $subject;
        $this->msg = $msg;
        $this->module = ($module) ? ucfirst($module) : '';
    }
}
