<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('roles')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%");
            })
            ->when($request->role, function ($query, $role) {
                $query->whereHas('roles', fn ($q) => $q->where('name', $role));
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('backend.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('backend.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        $user = User::create([
            'employee_id' => $this->generateEmployeeId(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'] ?? 'Active',
        ]);

        if ($request->hasFile('avatar')) {
            $user->update(['avatar' => $request->file('avatar')->store('avatars', 'public')]);
        }

        $user->assignRole($validated['role']);

        NotifyService::roles(
            ['Super Admin', 'Hospital Admin'],
            'New staff member added',
            "{$user->name} joined as {$validated['role']}.",
            route('admin.users.show', $user),
            'iconoir-user-plus',
            'success',
            auth()->id()
        );

        return redirect()->route('admin.users.index')->with('status', 'Staff member added successfully.');
    }

    public function show(User $user)
    {
        $user->load('roles');

        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $this->validated($request, $user);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => filled($validated['password'] ?? null) ? Hash::make($validated['password']) : $user->password,
            'phone' => $validated['phone'] ?? null,
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'] ?? $user->status,
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->update(['avatar' => $request->file('avatar')->store('avatars', 'public')]);
        }

        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('status', 'Staff member updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('status', "You can't change the status of your own account.");
        }

        $user->update(['status' => $user->status === 'Active' ? 'Inactive' : 'Active']);

        return back()->with('status', "Staff member marked as {$user->status}.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('status', "You can't delete your own account while logged in.");
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'Staff member removed successfully.');
    }

    private function validated(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email' . ($user ? ',' . $user->id : '')],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'phone' => ['nullable', 'string', 'max:30'],
            'designation' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:Male,Female,Other'],
            'date_of_birth' => ['nullable', 'date'],
            'joining_date' => ['nullable', 'date'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'in:Active,Inactive'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function generateEmployeeId(): string
    {
        do {
            $id = 'EMP-' . strtoupper(Str::random(6));
        } while (User::where('employee_id', $id)->exists());

        return $id;
    }
}
