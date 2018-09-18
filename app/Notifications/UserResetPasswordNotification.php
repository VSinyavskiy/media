<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Facades\Crypt;

class UserResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token     = $token;
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
                    ->subject('Восстановление пароля')
                    ->greeting('Здравствуйте!')
                    ->line('Вы получили это письмо потому что была попытка восстановления пароля для Вашего email. Нажмите на кнопку для продолжения!')
                    ->action('Восстановить пароль', route('password.reset', [$this->token, 'email' => Crypt::encryptString($notifiable->email)]))
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
