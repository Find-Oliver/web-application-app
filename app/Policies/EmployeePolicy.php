<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;

class EmployeePolicy
{
    /**
     * Check if user can view employees.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can view an employee.
     */
    public function view(User $user, Employee $employee): bool
    {
        // Admin can view all
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can view only themselves (if they have an associated employee record)
        // This would require checking if user has an employee_id field
        return false;
    }

    /**
     * Check if user can create employees.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can update employees.
     */
    public function update(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can delete employees.
     */
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can restore employees.
     */
    public function restore(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }
}
