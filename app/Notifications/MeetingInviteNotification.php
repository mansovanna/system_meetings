<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingInviteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    // ...existing code...

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Meeting Invitation')
            ->line('You have been invited to: ' . $this->meeting->title)
            ->line('Date: ' . $this->meeting->date)
            ->line('Location: ' . $this->meeting->location);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }


}
