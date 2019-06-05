<?php

namespace LaravelEnso\Core\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuthCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        app()->setLocale($notifiable->lang());

        return (new MailMessage())
            ->subject(__(config('app.name')).': '.__('Verification Code'))
            ->markdown('laravel-enso/core::emails.auth-code', [
                'name' => $notifiable->first_name.' '.$notifiable->last_name,
                'code' => $this->code
                // 'url' => url('password/reset/'.$this->token),
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
