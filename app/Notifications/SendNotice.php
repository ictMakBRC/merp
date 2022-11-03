<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendNotice extends Notification implements ShouldQueue
{
    use Queueable;

    private $senderName;

    private $senderEmail;

    private $notice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($senderName, $senderEmail, $notice)
    {
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->notice = $notice;
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
        ->from($this->senderEmail, $this->senderName)
        ->subject('Notice')
        ->greeting('Dear All')
        ->line($this->notice)
        ->action('Click to Login', config('app.url'))
        ->line('This Notice was sent by '.$this->senderName.' ('.$this->senderEmail.')');
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
