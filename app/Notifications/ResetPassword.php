<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Восстановление пароля от аккаунта: ' . config('app.name'))
            ->line('Ви надіслали запит на відновлення паролю. Щоб продовжити натисніть "Відновити".')
            ->action('Відновити', url('password/reset', $this->token))
            ->line('Якщо Ви не відправляли запит на відновлення пароля, ігноруйте це повідомлення.')
            ->line('З повагою, оргкомітет "Джаз-Вітраж".');
    }
}
