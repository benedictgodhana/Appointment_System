<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmationDoctor extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $patient;
    public $doctor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $patient, $doctor)
    {
        $this->appointment = $appointment;
        $this->patient = $patient;
        $this->doctor = $doctor;
    }
    
    public function build()
    {
        return $this->markdown('mail.reservation_confirmation_doctor');
    }
}
