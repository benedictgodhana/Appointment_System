<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    
    public $appointment;
    public $patient;
    public $doctor;

    public function __construct($appointment, $patient, $doctor)
    {
        $this->appointment = $appointment;
        $this->patient = $patient;
        $this->doctor = $doctor;
    }

    public function build()
    {
        return $this->markdown('mail.reservation_confirmation');
    }
}
