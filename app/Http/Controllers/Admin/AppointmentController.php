<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::query()
            ->with(['patient', 'doctor'])
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->when($request->date, fn ($query, $date) => $query->whereDate('appointment_date', $date))
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::where('status', 'Active')->orderBy('name')->get();

        return view('backend.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['status'] = 'Scheduled';
        $validated['serial_number'] = Appointment::nextSerialFor($validated['doctor_id'], $validated['appointment_date']);

        $appointment = Appointment::create($validated);

        \App\Services\NotifyService::roles(
            ['Super Admin', 'Hospital Admin', 'Receptionist'],
            'New appointment booked',
            $appointment->patient->name . ' scheduled with Dr. ' . $appointment->doctor->name . ' on ' . $appointment->appointment_date,
            route('admin.appointments.show', $appointment),
            'iconoir-calendar-plus',
            'primary',
            auth()->id()
        );

        if ($appointment->patient->email) {
            try {
                \Illuminate\Support\Facades\Mail::to($appointment->patient->email)
                    ->send(new \App\Mail\AppointmentConfirmationMail($appointment->load('doctor', 'patient')));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor']);

        return view('backend.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();

        return view('backend.appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Scheduled,Completed,Cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment deleted successfully.');
    }
}
