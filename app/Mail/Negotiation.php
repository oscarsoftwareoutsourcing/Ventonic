<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Negotiation extends Mailable
{
    use Queueable, SerializesModels;

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
