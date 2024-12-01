<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppointmentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name')) // Use .env values
            ->view('emails.appointment_status')
            ->subject("Your Appointment Status")
            ->with([
                'appointment' => $this->appointment,
                'status' => $this->status,
            ]);
    }
}