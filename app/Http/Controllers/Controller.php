<?php

namespace App\Http\Controllers;

use App\Models\Branch;

abstract class Controller
{
    /**
     * The branch a "Branch Admin" (or any other branch-restricted role) is
     * locked to, or null for Super Admin / Hospital Admin who see every
     * branch. Use this to scope queries and to auto-fill forms.
     */
    protected function currentBranchId(): ?int
    {
        $user = auth()->user();

        if (! $user) {
            return null;
        }

        if ($user->hasAnyRole(['Super Admin', 'Hospital Admin'])) {
            return null;
        }

        // Fail closed: an unassigned staff account must never fall back to
        // seeing every branch's data.
        abort_if($user->branch_id === null, 403, 'Your account is not assigned to a branch. Please contact an administrator.');

        return (int) $user->branch_id;
    }

    /**
     * Branch used for records created by global admins or public forms, which
     * have no branch selector/context of their own.
     */
    protected function defaultBranchId(): ?int
    {
        return $this->currentBranchId()
            ?? Branch::where('is_main', true)->value('id')
            ?? Branch::where('status', 'Active')->orderBy('id')->value('id');
    }

    protected function isBranchRestricted(): bool
    {
        return $this->currentBranchId() !== null;
    }

    /**
     * Apply a branch filter to a query builder, but only for branch-
     * restricted users. Super Admin / Hospital Admin queries pass through
     * untouched. $column is the column on the query's own table that holds
     * the branch id (defaults to "branch_id").
     */
    protected function scopeToBranch($query, string $column = 'branch_id')
    {
        if ($branchId = $this->currentBranchId()) {
            $query->where($column, $branchId);
        }

        return $query;
    }

    /**
     * Same idea, but for models one relation away from a branch_id column
     * (e.g. filtering Appointments by their Patient's branch_id).
     */
    protected function scopeToBranchVia($query, string $relation, string $column = 'branch_id')
    {
        if ($branchId = $this->currentBranchId()) {
            $query->whereHas($relation, fn ($q) => $q->where($column, $branchId));
        }

        return $query;
    }
}
