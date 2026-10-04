<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Check if user can manage employees.
     */
    public function manageEmployees(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can manage departments.
     */
    public function manageDepartments(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can manage positions.
     */
    public function managePositions(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can manage roles.
     */
    public function manageRoles(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can manage attendance.
     */
    public function manageAttendance(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can approve leave.
     */
    public function approveLeave(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can view reports.
     */
    public function viewReports(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can view activity logs.
     */
    public function viewActivityLogs(User $user): bool
    {
        return $user->isAdmin();
    }
}
