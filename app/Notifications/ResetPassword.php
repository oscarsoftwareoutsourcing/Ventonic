<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotify;
use App\Mail\Auth\ResetPasswordEmail;

class ResetPassword extends ResetPasswordNotify
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        try {
            $url = url(route('password.reset', [
                'token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()
            ], false));
            $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
            return (new ResetPasswordEmail($url, $count))->to($notifiable->email);
        } catch (Exception $e) {
            return (new MailMessage)
                ->subject(Lang::get('Reset Password Notification'))
                ->line(Lang::get(
                    'You are receiving this email because we received a password reset request for your account.'
                ))
                ->action(
                    Lang::get('Reset Password'),
                    url(route('password.reset', [
                        'token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()
                    ], false))
                )
                ->line(Lang::get('This password reset link will expire in :count minutes.', [
                    'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')
                ]))
                ->line(Lang::get('If you did not request a password reset, no further action is required.'));
        }
    }
}
