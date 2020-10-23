<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $url;
    public $urlText;
    public $msg;
    public $fromUserName;
    public $module;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $url, $urlText, $msg, $fromUserName)
    {
        $this->subject = $subject;
        $this->url = $url;
        $this->urlText = $urlText;
        $this->msg = $msg;
        $this->fromUserName = $fromUserName;
        $this->module = 'Valoración';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('mails.generic');
    }
}
