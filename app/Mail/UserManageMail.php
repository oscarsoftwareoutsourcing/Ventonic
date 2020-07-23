<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserManageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;
    public $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $msg, $attach = null)
    {
        $this->subject = $subject;
        $this->msg = $msg;
        $this->attach = $attach;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->attach !== null) {
            return $this->subject($this->subject)->view('email.send-mail')->attach($this->attach);
        }
        return $this->subject($this->subject)->view('email.send-mail');
    }
}
