<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AdminVerifyEmail extends VerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'admin.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Verifikasi Alamat Email Anda')
            ->greeting('Halo!')
            ->line('Terima kasih telah mendaftar. Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email', $url)
            ->line('Tautan ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak membuat akun ini, abaikan saja email ini.');
    }
}
