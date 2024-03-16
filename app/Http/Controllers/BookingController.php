<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;


use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmation;
use App\Mail\ReservationConfirmationDoctor;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
   

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'nullable|string',
        ];

        // Custom validation messages
        $messages = [
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'patient_id.exists' => 'The selected patient does not exist.',
        ];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the validated data
        $validatedData = $validator->validated();

        // Debugging: Dump the validated data

        
            // Create a new reservation instance
            $appointment = new Appointment();

            $appointment->doctor_id = $request->input('doctor_id');
            $appointment->patient_id = auth()->user()->id;
            $appointment->appointment_date = $request->input('appointment_date');
            $appointment->notes = $request->input('notes');
            $appointment->status = $request->input('status', 'pending');
            
            $appointment->save();

            $patient = auth()->user();
            $doctor = User::findOrFail($validatedData['doctor_id']);

        
            // Send email notifications to the patient and the doctor
            Mail::to($patient->email)->send(new ReservationConfirmation($appointment, $patient, $doctor));
            Mail::to($doctor->email)->send(new ReservationConfirmationDoctor($appointment, $patient, $doctor));
        

            // Flash a success message to the session
            session()->flash('success', 'Appointment submitted successfully.');

            // Redirect back to the reservation status page
            return redirect()->back();
       
    }
 

}
