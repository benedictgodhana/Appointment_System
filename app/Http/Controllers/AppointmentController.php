<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\User; // Assuming User model exists for doctors
use App\Mail\ReservationConfirmation;
use App\Mail\ReservationConfirmationDoctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'doctorName' => 'required|exists:users,id',
            'reason' => 'required|string',
            'doa' => 'required|date',
            'status' => 'required|string', // Corrected the validation rule
        ]);

        // Create a new appointment instance
        $appointment = new Appointment();
        $appointment->patient_id = auth()->user()->id; // Assuming you're using authentication
        $appointment->reason = $validatedData['reason'];
        $appointment->doctor_id = $validatedData['doctorName'];
        $appointment->appointment_datetime = $validatedData['doa'];
        $appointment->status = 'pending';
        $appointment->save();

        // Send email notifications
        $this->sendPatientConfirmationEmail($appointment);
        $this->sendDoctorNotificationEmail($appointment);

        // Redirect back to the reservation status page with a success message
        return redirect()->back()->with('success', 'Appointment created successfully.');
    }

    // Send confirmation email to the patient
    private function sendPatientConfirmationEmail($appointment)
    {
        $patientEmail = auth()->user()->email;
        Mail::to($patientEmail)->send(new ReservationConfirmation($appointment));
    }

    // Send notification email to the doctor
    private function sendDoctorNotificationEmail($appointment)
    {
        $doctorEmail = User::findOrFail($appointment->doctor_id)->email;
        Mail::to($doctorEmail)->send(new ReservationConfirmationDoctor($appointment));
    }
}
