<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Models\advisor;
use App\Models\advisee;

class AssignmentNotification extends Mailable
{
    use Queueable;

    private $advisorDescription;
    private $adviseeDescription;
    private $advisor;
    private $advisee;

    /**
     * Create a new notification instance.
     *
     * @param string|null $advisorDescription
     * @param string|null $adviseeDescription
     * @param advisor|null $advisor
     * @param advisee|null $advisee
     * @return void
     */
    public function __construct($advisorDescription, $adviseeDescription, $advisor, $advisee)
    {
        $this->advisorDescription = $advisorDescription;
        $this->adviseeDescription = $adviseeDescription;
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
        $greeting = 'Advisee Advisor Assignment';
        $description = $notifiable === $this->advisor ? $this->advisorDescription : $this->adviseeDescription;

        return $this->view('hop.emailassigned')
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
