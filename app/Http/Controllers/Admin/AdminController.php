<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bed;
use App\Models\Doctor;
use App\Models\DutyLog;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->hasRole('Doctor')) {
            return $this->doctorDashboard();
        }

        if ($user->hasAnyRole(['Nurse', 'Ward Boy', 'Cleaner'])) {
            return $this->staffDutyDashboard();
        }

        return $this->hospitalDashboard();
    }

    /**
     * Hospital-wide overview - Super Admin and Hospital Admin see every
     * branch; Branch Admin (and any other branch-restricted role sharing
     * this view) automatically sees only their own branch's numbers.
     */
    private function hospitalDashboard()
    {
        $weekStart = Carbon::today()->subDays(6);
        $appointmentsByDay = Appointment::selectRaw('DATE(appointment_date) as day, COUNT(*) as total')
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->where('appointment_date', '>=', $weekStart)
            ->where('appointment_date', '<=', today())
            ->groupBy('day')
            ->pluck('total', 'day');

        $weeklyLabels = [];
        $weeklyCounts = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $weekStart->copy()->addDays($i);
            $weeklyLabels[] = $date->format('D');
            $weeklyCounts[] = (int) ($appointmentsByDay[$date->format('Y-m-d')] ?? 0);
        }

        $patients = fn () => Patient::query()->tap(fn ($q) => $this->scopeToBranch($q));
        $doctors = fn () => Doctor::query()->tap(fn ($q) => $this->scopeToBranch($q));
        $appointments = fn () => Appointment::query()->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'));
        $beds = fn () => Bed::query()->tap(fn ($q) => $this->scopeToBranch($q));

        return view('backend.dashboard', [
            'currentBranch' => auth()->user()->branchRecord,
            'totalPatients' => $patients()->count(),
            'activePatients' => $patients()->where('status', 'Active')->count(),
            'totalDoctors' => $doctors()->count(),
            'activeDoctors' => $doctors()->where('status', 'Active')->count(),
            'todaysAppointments' => $appointments()->with(['patient', 'doctor'])
                ->whereDate('appointment_date', today())
                ->orderBy('appointment_time')
                ->limit(5)
                ->get(),
            'bedCounts' => [
                'total' => $beds()->count(),
                'available' => $beds()->where('status', 'Available')->count(),
                'occupied' => $beds()->where('status', 'Occupied')->count(),
            ],
            'onDutyCount' => DutyLog::tap(fn ($q) => $this->scopeToBranchVia($q, 'user'))->where('status', 'Ongoing')->count(),
            'weeklyLabels' => $weeklyLabels,
            'weeklyCounts' => $weeklyCounts,
            'appointmentStatusCounts' => [
                'Scheduled' => $appointments()->where('status', 'Scheduled')->count(),
                'Completed' => $appointments()->where('status', 'Completed')->count(),
                'Cancelled' => $appointments()->where('status', 'Cancelled')->count(),
            ],
            'recentPatients' => $patients()->latest()->limit(5)->get(),
            'recentInvoices' => Invoice::with('patient')->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))->latest('invoice_date')->limit(5)->get(),
        ]);
    }

    /**
     * Doctor's own dashboard - only the patients assigned to them.
     */
    private function doctorDashboard()
    {
        $doctor = Doctor::where('user_id', auth()->id())->first();

        if (! $doctor) {
            return view('backend.dashboard-doctor', ['doctor' => null, 'todayAppointments' => collect(), 'upcomingAppointments' => collect()]);
        }

        $todayAppointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        $upcomingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', '>', today())
            ->where('status', 'Scheduled')
            ->get();

        return view('backend.dashboard-doctor', compact('doctor', 'todayAppointments', 'upcomingAppointments'));
    }

    /**
     * Floor staff dashboard (Nurse / Ward Boy / Cleaner) - their own current
     * task and recent duty history, per the real-time duty tracking system.
     */
    private function staffDutyDashboard()
    {
        $userId = auth()->id();

        $currentDuty = DutyLog::where('user_id', $userId)
            ->where('status', 'Ongoing')
            ->latest('started_at')
            ->first();

        $completedTodayCount = DutyLog::where('user_id', $userId)
            ->where('status', 'Completed')
            ->whereDate('ended_at', today())
            ->count();

        $recentDuties = DutyLog::where('user_id', $userId)
            ->orderBy('started_at', 'desc')
            ->limit(10)
            ->get();

        return view('backend.dashboard-staff', compact('currentDuty', 'completedTodayCount', 'recentDuties'));
    }

    public function showLockScreen()
    {
        return view('backend.auth.lock-screen');
    }
}
