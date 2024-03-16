<!-- resources/views/mail/reservation_confirmation.blade.php -->

@component('mail::message')
# Reservation Confirmation

Hello {{ $patient->name }},

We are pleased to confirm your appointment with Dr. {{ $doctor->name }} on {{ date('l, F j, Y', strtotime($appointment->appointment_date)) }} at {{ date('g:i A', strtotime($appointment->appointment_date)) }}.

@if ($appointment->notes)
## Reason
{{ $appointment->notes }}
@endif


Thank you for using our Appointment System.

@endcomponent
