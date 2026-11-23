<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DutyLog;
use App\Models\User;
use Illuminate\Http\Request;

class DutyLogController extends Controller
{
    public function index(Request $request)
    {
        $ongoing = DutyLog::with('user')
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'user'))
            ->where('status', 'Ongoing')
            ->when($request->location, fn ($q, $loc) => $q->where('location', 'like', "%{$loc}%"))
            ->orderBy('started_at', 'desc')
            ->get();

        $completedToday = DutyLog::with('user')
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'user'))
            ->where('status', 'Completed')
            ->whereDate('ended_at', today())
            ->orderBy('ended_at', 'desc')
            ->paginate(10);

        $locations = DutyLog::select('duty_logs.location')
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'user'))
            ->distinct()
            ->orderBy('duty_logs.location')
            ->pluck('location');

        return view('backend.duty-logs.index', compact('ongoing', 'completedToday', 'locations'));
    }

    public function create()
    {
        $staff = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['Nurse', 'Ward Boy', 'Cleaner', 'Receptionist', 'Lab Technician', 'Pharmacist']);
        })->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.duty-logs.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location' => ['required', 'string', 'max:100'],
            'task' => ['required', 'string', 'max:255'],
            'started_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->assertUserInCurrentBranch($validated['user_id']);

        $user = User::findOrFail($validated['user_id']);
        $validated['role_at_time'] = $user->roles->first()->name ?? null;
        $validated['status'] = 'Ongoing';

        DutyLog::create($validated);

        return redirect()->route('admin.duty-logs.index')->with('status', 'Duty assigned successfully.');
    }

    public function edit(DutyLog $dutyLog)
    {
        $this->authorizeBranchAccess($dutyLog);

        $staff = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['Nurse', 'Ward Boy', 'Cleaner', 'Receptionist', 'Lab Technician', 'Pharmacist']);
        })->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.duty-logs.edit', compact('dutyLog', 'staff'));
    }

    public function update(Request $request, DutyLog $dutyLog)
    {
        $this->authorizeBranchAccess($dutyLog);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location' => ['required', 'string', 'max:100'],
            'task' => ['required', 'string', 'max:255'],
            'started_at' => ['required', 'date'],
            'status' => ['required', 'in:Ongoing,Completed'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->assertUserInCurrentBranch($validated['user_id']);

        if ($validated['status'] === 'Completed' && $dutyLog->status !== 'Completed') {
            $validated['ended_at'] = now();
        } elseif ($validated['status'] === 'Ongoing') {
            $validated['ended_at'] = null;
        }

        $dutyLog->update($validated);

        return redirect()->route('admin.duty-logs.index')->with('status', 'Duty log updated successfully.');
    }

    public function destroy(DutyLog $dutyLog)
    {
        $this->authorizeBranchAccess($dutyLog);

        $dutyLog->delete();

        return redirect()->route('admin.duty-logs.index')->with('status', 'Duty log removed.');
    }

    public function complete(DutyLog $dutyLog)
    {
        $this->authorizeBranchAccess($dutyLog);

        $dutyLog->update([
            'status' => 'Completed',
            'ended_at' => now(),
        ]);

        return back()->with('status', 'Marked as completed.');
    }

    private function assertUserInCurrentBranch(int $userId): void
    {
        $branchId = $this->currentBranchId();

        if ($branchId !== null) {
            abort_unless(
                User::where('id', $userId)->where('branch_id', $branchId)->exists(),
                403,
                'That staff member belongs to a different branch.'
            );
        }
    }

    private function authorizeBranchAccess(DutyLog $dutyLog): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId !== null && (int) $dutyLog->user?->branch_id !== $branchId, 403, 'This duty log belongs to a different branch.');
    }
}
