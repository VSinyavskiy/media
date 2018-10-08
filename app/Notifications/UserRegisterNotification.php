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
                    ->subject(__('app.emails.user_register_notification.subject'))
                    ->greeting(__('app.emails.user_register_notification.greeting'))
                    ->line(__('app.emails.user_register_notification.first_line'))
                    ->action(__('app.emails.user_register_notification.button'), route('register.confirm', [$notifiable->mail_token, '#open-registration-confirmed-email']))
                    ->line(__('app.emails.user_register_notification.second_line'));
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
