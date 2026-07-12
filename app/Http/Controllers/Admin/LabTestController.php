<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function index(Request $request)
    {
        $labTests = LabTest::query()
            ->when($request->search, fn ($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('backend.lab.tests.index', compact('labTests'));
    }

    public function create()
    {
        return view('backend.lab.tests.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateTest($request);
        $validated['status'] = 'Active';

        LabTest::create($validated);

        return redirect()->route('admin.lab-tests.index')->with('status', 'Lab test added successfully.');
    }

    public function edit(LabTest $labTest)
    {
        return view('backend.lab.tests.edit', compact('labTest'));
    }

    public function update(Request $request, LabTest $labTest)
    {
        $validated = $this->validateTest($request);
        $validated['status'] = $request->input('status', 'Active');

        $labTest->update($validated);

        return redirect()->route('admin.lab-tests.index')->with('status', 'Lab test updated successfully.');
    }

    public function destroy(LabTest $labTest)
    {
        $labTest->delete();

        return redirect()->route('admin.lab-tests.index')->with('status', 'Lab test removed successfully.');
    }

    private function validateTest(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'sample_type' => ['nullable', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
