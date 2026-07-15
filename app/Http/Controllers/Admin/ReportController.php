<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\LabOrder;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->filled('from') ? Carbon::parse($request->from) : now()->subDays(29)->startOfDay();
        $to = $request->filled('to') ? Carbon::parse($request->to)->endOfDay() : now()->endOfDay();

        // Revenue summary
        $invoicesInRange = Invoice::whereBetween('invoice_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->get();
        $totalRevenue = $invoicesInRange->sum('total');
        $totalCollected = $invoicesInRange->sum('paid_amount');
        $totalDue = $invoicesInRange->sum('due_amount');

        $totalExpenses = Expense::whereBetween('expense_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->sum('amount');
        $netProfit = $totalCollected - $totalExpenses;

        // Daily revenue trend
        $revenueByDay = Invoice::selectRaw('DATE(invoice_date) as day, SUM(total) as total')
            ->whereBetween('invoice_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->groupBy('day')
            ->pluck('total', 'day');

        $days = [];
        $revenueSeries = [];
        $period = Carbon::parse($from)->toPeriod($to);
        foreach ($period as $date) {
            $days[] = $date->format('d M');
            $revenueSeries[] = (float) ($revenueByDay[$date->format('Y-m-d')] ?? 0);
        }

        // Appointments summary
        $appointmentsInRange = Appointment::whereBetween('appointment_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->get();
        $appointmentStatusCounts = [
            'Scheduled' => $appointmentsInRange->where('status', 'Scheduled')->count(),
            'Completed' => $appointmentsInRange->where('status', 'Completed')->count(),
            'Cancelled' => $appointmentsInRange->where('status', 'Cancelled')->count(),
        ];

        // Doctor-wise patient load (appointments per doctor in range)
        $doctorLoad = Appointment::with('doctor')
            ->whereBetween('appointment_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->get()
            ->groupBy('doctor_id')
            ->map(function ($group) {
                return [
                    'doctor' => $group->first()->doctor,
                    'count' => $group->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values();

        // New patient registrations in range
        $newPatients = Patient::whereBetween('created_at', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->count();

        // Lab orders summary
        $labOrdersInRange = LabOrder::whereBetween('ordered_date', [$from, $to])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->get();

        // Low stock medicines (not date-scoped, always "right now")
        $lowStockMedicines = Medicine::whereColumn('stock_quantity', '<=', 'reorder_level')
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->orderBy('stock_quantity')
            ->limit(10)
            ->get();

        return view('backend.reports.index', [
            'from' => $from,
            'to' => $to,
            'totalRevenue' => $totalRevenue,
            'totalCollected' => $totalCollected,
            'totalDue' => $totalDue,
            'totalExpenses' => $totalExpenses,
            'netProfit' => $netProfit,
            'revenueLabels' => $days,
            'revenueSeries' => $revenueSeries,
            'totalAppointments' => $appointmentsInRange->count(),
            'appointmentStatusCounts' => $appointmentStatusCounts,
            'doctorLoad' => $doctorLoad,
            'newPatients' => $newPatients,
            'totalDoctors' => Doctor::tap(fn ($q) => $this->scopeToBranch($q))->count(),
            'labOrdersCount' => $labOrdersInRange->count(),
            'labOrdersCompleted' => $labOrdersInRange->where('status', 'Completed')->count(),
            'lowStockMedicines' => $lowStockMedicines,
        ]);
    }
}
