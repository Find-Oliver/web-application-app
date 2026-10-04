<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeaveRequest;

class LeaveRequestPolicy
{
    /**
     * Check if user can view leave requests.
     */
    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can view all
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can view only their own
        return $user->id === $leaveRequest->employee_id;
    }

    /**
     * Check if user can create leave requests.
     */
    public function create(User $user): bool
    {
        return $user->isEmployee() || $user->isAdmin();
    }

    /**
     * Check if user can update leave request.
     */
    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can update all
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can update only their own pending requests
        if ($user->id !== $leaveRequest->employee_id) {
            return false;
        }

        return $leaveRequest->status === 'Pending';
    }

    /**
     * Check if user can delete leave request.
     */
    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can delete all
        if ($user->isAdmin()) {
            return true;
        }

        // Employee can cancel only their own pending requests
        if ($user->id !== $leaveRequest->employee_id) {
            return false;
        }

        return $leaveRequest->status === 'Pending';
    }

    /**
     * Check if user can approve leave request.
     */
    public function approve(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can reject leave request.
     */
    public function reject(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }
}
