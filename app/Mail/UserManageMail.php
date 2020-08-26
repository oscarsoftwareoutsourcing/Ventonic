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
        /** Condición que evalúa si posee archivos adjuntos */
        if ($this->attach !== null && count($this->attach) > 0) {
            $mail = $this->subject($this->subject)->view('email.send-mail');

            /** envia varios archivos adjuntos si el attributo $attach es un arreglo */
            if (is_array($this->attach)) {
                foreach ($this->attach as $attach) {
                    if (strpos($attach, 'http') === false) {
                        $mail->attach($attach);
                    } else {
                        $this->msg .= $attach;
                    }
                }
            }

            return $mail;
        }

        return $this->subject($this->subject)->view('email.send-mail');
    }
}
