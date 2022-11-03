<?php

namespace App\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
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
    // public function toMail($notifiable)
    // {
    //    return (new MailMessage)->view(
    //     'emails.name', ['invoice' => $this->invoice]
    // );

    // }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Leave Request Update')
                    ->greeting($this->details['greeting'])
                    ->line($this->details['body'])
                    ->action('Click to Login', config('app.url'))
                    ->line('Thank you for using our application!');
    }

    public function failed(Exception $e)
    {
        \Illuminate\Support\Facades\Log::debug('MyNotification failed');
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
