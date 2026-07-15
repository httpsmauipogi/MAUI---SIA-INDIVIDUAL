<?php

namespace App\Http\Controllers;

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

        return $user->branch_id;
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
