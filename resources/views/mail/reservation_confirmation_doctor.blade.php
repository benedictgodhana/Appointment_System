<!-- resources/views/mail/reservation_confirmation_doctor.blade.php -->

@component('mail::message')
# New Appointment Notification

Hello Dr. {{ $doctor->name }},

We are pleased to confirm your appointment on {{ date('l, F j, Y', strtotime($appointment->appointment_date)) }} at {{ date('g:i A', strtotime($appointment->appointment_date)) }}.

@if ($appointment->notes)
## reason
{{ $appointment->notes }}
@endif


Thank you for using our Appointment System.

@endcomponent
