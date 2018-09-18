<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {  
        return (new MailMessage)
                    ->from('noreply@' . $_SERVER['HTTP_HOST'], env('APP_NAME'))
                    ->subject('Подтверждение регистрации')
                    ->greeting('Здравствуйте!')
                    ->line('Для успешного прохождения регистрации перейдите по ссылке ниже!')
                    ->action('Присоединиться к игре!', route('register.confirm', [$notifiable->mail_token, '#open-registration-confirmed-email']))
                    ->line('If you have not tried to recover a password, contact the administrator!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
