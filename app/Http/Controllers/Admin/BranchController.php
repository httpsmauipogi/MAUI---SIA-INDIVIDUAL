<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount(['doctors', 'staff'])->orderByDesc('is_main')->orderBy('name')->get();

        return view('backend.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('backend.branches.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if (! empty($validated['is_main'])) {
            Branch::where('is_main', true)->update(['is_main' => false]);
        }

        Branch::create($validated);

        return redirect()->route('admin.branches.index')->with('status', 'Branch added successfully.');
    }

    public function show(Branch $branch)
    {
        $branch->load(['doctors', 'staff', 'admins']);

        return view('backend.branches.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        return view('backend.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $this->validated($request, $branch->id);

        if (! empty($validated['is_main'])) {
            Branch::where('is_main', true)->where('id', '!=', $branch->id)->update(['is_main' => false]);
        }

        $branch->update($validated);

        return redirect()->route('admin.branches.index')->with('status', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->doctors()->exists() || $branch->staff()->exists() || $branch->patients()->exists()) {
            return back()->with('error', 'Cannot delete this branch while doctors, staff, or patients are still assigned to it. Reassign them first.');
        }

        $branch->delete();

        return redirect()->route('admin.branches.index')->with('status', 'Branch removed successfully.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', 'unique:branches,code' . ($ignoreId ? ",{$ignoreId}" : '')],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:2000'],
            'manager_name' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Inactive'],
            'is_main' => ['nullable', 'boolean'],
        ]);

        $validated['is_main'] = $request->boolean('is_main');

        return $validated;
    }
}
