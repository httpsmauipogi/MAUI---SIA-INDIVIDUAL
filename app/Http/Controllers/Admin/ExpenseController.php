<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = Expense::query()
            ->when($request->category, fn ($q, $category) => $q->where('category', $category))
            ->when($request->from, fn ($q, $from) => $q->whereDate('expense_date', '>=', $from))
            ->when($request->to, fn ($q, $to) => $q->whereDate('expense_date', '<=', $to))
            ->orderBy('expense_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $totalThisMonth = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        $totalAllTime = Expense::sum('amount');

        return view('backend.expenses.index', [
            'expenses' => $expenses,
            'categories' => Expense::CATEGORIES,
            'totalThisMonth' => $totalThisMonth,
            'totalAllTime' => $totalAllTime,
        ]);
    }

    public function create()
    {
        return view('backend.expenses.create', ['categories' => Expense::CATEGORIES]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateExpense($request);
        $validated['recorded_by'] = auth()->id();

        Expense::create($validated);

        return redirect()->route('admin.expenses.index')->with('status', 'Expense recorded successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('backend.expenses.edit', ['expense' => $expense, 'categories' => Expense::CATEGORIES]);
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $this->validateExpense($request);

        $expense->update($validated);

        return redirect()->route('admin.expenses.index')->with('status', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.expenses.index')->with('status', 'Expense removed successfully.');
    }

    private function validateExpense(Request $request): array
    {
        return $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'expense_date' => ['required', 'date'],
            'paid_to' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
