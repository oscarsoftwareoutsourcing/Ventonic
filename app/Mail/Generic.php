<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Generic extends Mailable
{
    use Queueable, SerializesModels;

    public $fromUserName;
    public $fromUserEmail;
    public $subject;
    public $msg;
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromUserEmail)->view('mails.generic');
    }
}
