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

    public $fromUserName;
    public $fromUserEmail;
    public $subject;
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromUserEmail)->view('mails.negotiation');
    }
}
