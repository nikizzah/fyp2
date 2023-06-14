<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Models\advisor;
use App\Models\advisee;

class emailOne extends Mailable
{
    use Queueable;
    private $emailContent;
    private $emailSubject;
    private $advisee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emailContent, $emailSubject, $advisee)
    {
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->advisee = $advisee;
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
        $greeting = $this->emailSubject;
        $description = $this->emailContent;

        return $this->view('advisor.emailone')
        ->subject($greeting)
        ->with([
            'description' => $description,
        ]);
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
