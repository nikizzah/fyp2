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

class EmailAll extends Mailable
{
    private $emailContent;
    private $emailSubject;
    private $advisor;
    private $advisee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emailContent, $emailSubject, $advisor, $advisee)
    {
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->advisor = $advisor;
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

        return $this->view('advisor.emailall')
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
