<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PatientPortalController extends Controller
{
    /**
     * Resolve the Patient record linked to the currently logged-in user,
     * or abort with a friendly message if the account isn't linked yet.
     */
    private function patient()
    {
        return auth()->user()->patient;
    }

    public function dashboard()
    {
        $patient = $this->patient();

        if (! $patient) {
            return view('patient.unlinked');
        }

        $upcomingAppointments = Appointment::where('patient_id', $patient->id)
            ->where('appointment_date', '>=', today())
            ->where('status', 'Scheduled')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->with('doctor')
            ->limit(5)
            ->get();

        $recentPrescriptionsCount = Prescription::where('patient_id', $patient->id)->count();

        $dueInvoicesTotal = Invoice::where('patient_id', $patient->id)
            ->whereIn('status', ['Unpaid', 'Partial'])
            ->get()
            ->sum('due_amount');

        return view('patient.dashboard', compact('patient', 'upcomingAppointments', 'recentPrescriptionsCount', 'dueInvoicesTotal'));
    }

    public function appointments()
    {
        $patient = $this->patient();
        if (! $patient) {
            return view('patient.unlinked');
        }

        $appointments = Appointment::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);

        return view('patient.appointments', compact('appointments'));
    }

    public function prescriptions()
    {
        $patient = $this->patient();
        if (! $patient) {
            return view('patient.unlinked');
        }

        $prescriptions = Prescription::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('prescription_date', 'desc')
            ->paginate(10);

        return view('patient.prescriptions', compact('prescriptions'));
    }

    public function prescriptionShow(Prescription $prescription)
    {
        $patient = $this->patient();
        abort_unless($patient && $prescription->patient_id === $patient->id, 403);

        $prescription->load('doctor');

        return view('patient.prescription-show', compact('prescription'));
    }

    public function invoices()
    {
        $patient = $this->patient();
        if (! $patient) {
            return view('patient.unlinked');
        }

        $invoices = Invoice::where('patient_id', $patient->id)
            ->orderBy('invoice_date', 'desc')
            ->paginate(10);

        return view('patient.invoices', compact('invoices'));
    }

    public function invoiceShow(Invoice $invoice)
    {
        $patient = $this->patient();
        abort_unless($patient && $invoice->patient_id === $patient->id, 403);

        return view('patient.invoice-show', compact('invoice'));
    }

    public function editProfile()
    {
        $patient = $this->patient();
        if (! $patient) {
            return view('patient.unlinked');
        }

        return view('patient.profile', compact('patient'));
    }

    public function updateProfile(Request $request)
    {
        $patient = $this->patient();
        abort_unless($patient, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'address' => ['nullable', 'string'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
        ]);

        $patient->update($validated);
        auth()->user()->update(['name' => $validated['name']]);

        return back()->with('status', 'Profile updated successfully.');
    }
}
